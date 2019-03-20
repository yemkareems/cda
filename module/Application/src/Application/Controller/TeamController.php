<?php
namespace Application\Controller;

use Application\Entity\Team;
use Application\page\TeamAddFilter;
use Application\page\TeamAddForm;
use Zend\View\Model\ViewModel;

class TeamController extends BaseController
{
    public function addAction()
    {
        $this->checkUserIdentity();
        $messages = array();
        $teamAddForm = new TeamAddForm();
        $config = $this->getConfig();
        $teamAddForm->setAttribute('action', $config['router']['routes']['team-add']['options']['route']);
        $request = $this->getRequest();
        $loggedInDetails = $this->getEntityManager()->getRepository('Application\Entity\EmployeeDetails')->findOneBy(array("emp" => $this->user));

        if ($request->isPost()) {
            $data = $request->getPost();
            $teamAddForm->setInputFilter(new TeamAddFilter());
            $teamAddForm->setData($data);
            if ($teamAddForm->isValid()) {
                $team = new Team();
                $teamParams = array(
                    Team::FIELD_NAME => $data['name'],
                    Team::FIELD_COMPANY => $loggedInDetails->getCompany()
                );
                $this->setAttributes($team, $teamParams);
                try {
                    $this->em->flush();
                    //redirecting
                    $this->redirect()->toRoute('team-add');
                } catch (\Exception $e) {
                    $this->handleException($e);
                }
            }
        }

        return new ViewModel(array(
            'teamAddForm' => $teamAddForm,
            'messages' => $messages,
        ));
    }

    public function listAction()
    {
        $this->checkUserIdentity();
        $view = array();
        $loggedInDetails = $this->getEntityManager()->getRepository('Application\Entity\EmployeeDetails')->findOneBy(array("emp" => $this->user));
        $team = $this->getEntityManager()->getRepository('Application\Entity\Team')->findBy(array('company' => $loggedInDetails->getCompany()), array("id" => "DESC"));

        foreach ($team as $tObj) {
            $view[] = array(
                'id' => $tObj->getId(),
                'name' => ucfirst($tObj->getName())
            );
        }
        print_r(json_encode($view));
        exit;
    }

    public function compareAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {
            $data = $request->getPost();
            //print_r($data);
            $postData = $this->params()->fromPost();
            $postData['year'] = isset($postData['year']) ? $postData['year'] : $this->getYear();
            $postData['quarter'] = isset($postData['quarter']) ? $postData['quarter'] : $this->getQuarter();


        }

        return new ViewModel(array(
            'postData' => $postData

        ));
    }

}