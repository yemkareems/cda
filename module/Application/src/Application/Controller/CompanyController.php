<?php
namespace Application\Controller;

use Application\Entity\Company;
use Application\Entity\Employee;
use Application\Entity\EmployeeDetails;
use Application\Entity\Role;
use Application\page\CompanyAddFilter;
use Application\page\CompanyAddForm;
use Zend\View\Model\ViewModel;

class CompanyController extends BaseController
{
    public function addAction()
    {
        $this->checkUserIdentity();
        $messages = array();
        $companyAddForm = new CompanyAddForm();
        $config = $this->getConfig();
        $companyAddForm->setAttribute('action', $config['router']['routes']['company-add']['options']['route']);
        $request = $this->getRequest();

        if ($request->isPost()) {
            $data = $request->getPost();
            //check if an employee with same email already exists
            $employee = $this->getEntityManager()->getRepository('Application\Entity\Employee')->findOneBy(array('email' => $data['email']));
            if ($employee instanceof Employee) {
                $messages[] = 'Email address already exists.';
            }
            $companyAddForm->setInputFilter(new CompanyAddFilter());
            $companyAddForm->setData($data);
            if ($companyAddForm->isValid()) {
                //company
                $company = new Company();
                $companyParams = array(
                    Company::FIELD_NAME => $data['company']
                );
                $this->setAttributes($company, $companyParams);
                //Employee
                $employee = new Employee();
                $data['password'] = $this->generatePassword();
                $employeeParams = array(
                    Employee::FIELD_EMP_CODE => $data['password'],                //TODO::Replace emp code password with 000
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
                $role = $this->getEntityManager()->getRepository('Application\Entity\Role')->findOneBy(array("name" => Role::COMPANY_ADMIN));
                $employeeDetailsParams = array(
                    EmployeeDetails::FIELD_COMPANY => $company,
                    EmployeeDetails::FIELD_EMPLOYEE => $employee,
                    EmployeeDetails::FIELD_ROLE => $role
                );
                $this->setAttributes($employeeDetails, $employeeDetailsParams);
                try {
                    $this->em->flush();
                    //send email
                    $from = array(
                        'email' => $this->user->getEmail(),
                        'name' => $this->user->getFirstname()
                    );
                    $to = array($data['email']);
                    $subject = self::SUBJECT_COMPANY_CREATED;
                    $body = $this->getMailBody($subject, $data);
                    $this->sendMail($from, $to, $subject, $body);
                    //redirecting
                    $this->redirect()->toRoute('company-add');
                } catch (\Exception $e) {
                    $this->handleException($e);
                }
            }
        }
        return new ViewModel(array(
            'companyAddForm' => $companyAddForm,
            'messages' => $messages,
        ));
    }

    public function listAction()
    {
        $view = array();
        $company = $this->getEntityManager()->getRepository('Application\Entity\Company')->findBy(array(), array("id" => "DESC"));
        $role = $this->getEntityManager()->getRepository('Application\Entity\Role')->findOneBy(array("name" => Role::COMPANY_ADMIN));

        foreach ($company as $cObj) {
            $employeeDetails = $this->getEntityManager()->getRepository('Application\Entity\EmployeeDetails')->findOneBy(array('company' => $cObj, 'role' => $role), array("id" => "DESC"));
            if(is_object($employeeDetails)) {
                $view[] = array(
                    'id' => $cObj->getId(),
                    'company' => ucfirst($cObj->getName()),
                    'firstname' => ucfirst($employeeDetails->getEmp()->getFirstname()),
                    'lastname' => ucfirst($employeeDetails->getEmp()->getLastName()),
                    'email' => $employeeDetails->getEmp()->getEmail()
                );
            }
        }
        print_r(json_encode($view));
        exit;
    }

}