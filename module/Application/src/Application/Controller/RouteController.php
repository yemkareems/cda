<?php
namespace Application\Controller;

use Application\Entity\Role;
use Application\Entity\Radar;

use Zend\Mvc\Controller\AbstractActionController;

class RouteController extends AbstractActionController
{
    public function indexAction()
    {
        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');

        if (!$auth->hasIdentity()) {
            return $this->redirect()->toRoute('login');
        }

        $identity = $auth->getIdentity();
        $userDetails = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->getRepository('Application\Entity\EmployeeDetails')->findOneBy(array("emp" => $identity->getId()));
        $role = $userDetails->getRole();
        switch ($role->getName()) {
            case Role::HPTA_ADMIN:
                $redirectUrl = 'question-add';
                break;
            case Role::COMPANY_ADMIN:
                $redirectUrl = 'team-add';
                break;
            case Role::TEAM_MEMBER:
                //$redirectUrl = 'survey-radar';
                $redirectUrl = 'survey-take';
                $params['year'] = date("Y");
                $params['empId'] = $userDetails->getEmp()->getId();
                $month = date('m', time());
                $params['quarter'] = ceil($month/3);
                $params['radarType'] = Radar::TYPE_TEAM;


                $result = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->getRepository('Application\Entity\RatingQuarter')->findLastSubCategory($params);


                $redirectParam = array('subcategoryId' => $result);
                break;
            default:
                $redirectUrl = 'error';
                break;
        }

        //return $this->redirect()->toRoute($redirectUrl);
        return isset($redirectParam) ? $this->redirect()->toRoute($redirectUrl, $redirectParam) : $this->redirect()->toRoute($redirectUrl);
    }
}