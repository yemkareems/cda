<?php
namespace Application\Controller;

use Application\Entity\EmployeeTeam;
use Application\Entity\Role;
use Application\Entity\Employee;
use Application\Entity\EmployeeDetails;
use Application\page\TeamMemberAddFilter;
use Application\page\TeamMemberAddForm;
use Zend\View\Model\ViewModel;

class TeamMemberController extends BaseController
{
    public function addAction()
    {
        $this->checkUserIdentity();
        $messages = array();
        $teamMemberAddForm = new TeamMemberAddForm();
        $config = $this->getConfig();
        $teamMemberAddForm->setAttribute('action', $config['router']['routes']['team-member-add']['options']['route']);
        $request = $this->getRequest();

        //prefill teams
        $teams = array();
        $loggedInDetails = $this->getEntityManager()->getRepository('Application\Entity\EmployeeDetails')->findOneBy(array("emp" => $this->user));
        $team = $this->getEntityManager()->getRepository('Application\Entity\Team')->findBy(array('company' => $loggedInDetails->getCompany()), array("id" => "DESC"));
        foreach ($team as $obj) {
            $teams[$obj->getId()] = ucfirst($obj->getName());
        }
        asort($teams);
        $teamMemberAddForm->get('team')->setAttribute('options', $teams);

        if ($request->isPost()) {
            $data = $request->getPost();
            //check if an employee with same email already exists
            $employee = $this->getEntityManager()->getRepository('Application\Entity\Employee')->findOneBy(array('email' => $data['email']));
            if ($employee instanceof Employee) {
                $messages[] = 'Email address already exists.';
            }
            $teamMemberAddForm->setInputFilter(new TeamMemberAddFilter());
            $teamMemberAddForm->setData($data);
            if ($teamMemberAddForm->isValid()) {
                $loggedInDetails = $this->getEntityManager()->getRepository('Application\Entity\EmployeeDetails')->findOneBy(array("emp" => $this->user));
                $data['password'] = $this->generatePassword();
                //Employee
                $employee = new Employee();
                $employeeParams = array(
                    Employee::FIELD_EMP_CODE => $data['code'],
                    Employee::FIELD_CREATED_AT => new \DateTime(),
                    Employee::FIELD_CREATED_BY => $this->user->getId(),
                    Employee::FIELD_EMAIL => $data['email'],
                    Employee::FIELD_FIRSTNAME => $data['firstname'],
                    Employee::FIELD_LASTNAME => $data['lastname'],
                    Employee::FIELD_PASSWORD => md5($data['password'])
                );
                $this->setAttributes($employee, $employeeParams);
                //Employee Details
                $employeeDetails = new EmployeeDetails();
                $employeeDetailsParams = array(
                    EmployeeDetails::FIELD_COMPANY => $loggedInDetails->getCompany(),
                    EmployeeDetails::FIELD_EMPLOYEE => $employee,
                    EmployeeDetails::FIELD_ROLE => $this->getEntityManager()->getRepository('Application\Entity\Role')->findOneBy(array("name" => Role::TEAM_MEMBER)),
                );
                $this->setAttributes($employeeDetails, $employeeDetailsParams);
                //Employee Team
                $employeeTeam = new EmployeeTeam();
                $employeeTeamParams = array(
                    EmployeeTeam::FIELD_EMPLOYEE => $employee,
                    EmployeeTeam::FIELD_TEAM => $this->getEntityManager()->getRepository('Application\Entity\Team')->findOneBy(array("id" => $data['team'])),
                );
                $this->setAttributes($employeeTeam, $employeeTeamParams);
                try {
                    $this->em->flush();
                    //send email
                    $from = array(
                        'email' => $this->user->getEmail(),
                        'name' => $this->user->getFirstname()
                    );                    $to = array($data['email']);
                    $subject = self::SUBJECT_TEAM_MEMBER_CREATED;
                    $body = $this->getMailBody($subject, $data);
                    $this->sendMail($from, $to, $subject, $body);
                    //redirecting
                    $this->redirect()->toRoute('team-member-add');
                } catch (\Exception $e) {
                    $this->handleException($e);
                }
            }
        }

        return new ViewModel(array(
            'teamMemberAddForm' => $teamMemberAddForm,
            'messages' => $messages,
        ));
    }

    public function listAction()
    {
        $view = array();
        $this->checkUserIdentity();
        $loggedInDetails = $this->getEntityManager()->getRepository('Application\Entity\EmployeeDetails')->findOneBy(array("emp" => $this->user));
        $role = $this->getEntityManager()->getRepository('Application\Entity\Role')->findOneBy(array("name" => Role::TEAM_MEMBER));
        $company = $loggedInDetails->getCompany();
        $employeeDetails = $this->getEntityManager()->getRepository('Application\Entity\EmployeeDetails')->findBy(array('company' => $company, 'role' => $role), array("id" => "DESC"));
        foreach ($employeeDetails as $employeeDetail) {
            if(is_object($employeeDetail)) {
                if(is_object($employeeDetail->getEmp()->getEmployeeTeam())) {
                    $view[] = array(
                        'id' => $employeeDetail->getEmp()->getId(),
                        'company' => ucfirst($company->getName()),
                        'firstname' => ucfirst($employeeDetail->getEmp()->getFirstname()),
                        'lastname' => ucfirst($employeeDetail->getEmp()->getLastName()),
                        'email' => $employeeDetail->getEmp()->getEmail(),
                        'team' => ucfirst($employeeDetail->getEmp()->getEmployeeTeam()->getName()),

                    );
                }
            }
        }
        print_r(json_encode($view));
        exit;
    }
}