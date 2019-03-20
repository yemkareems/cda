<?php
namespace Application\Controller;

use Application\Entity\Options;
use Application\Entity\Question;
use Application\page\QuestionAddFilter;
use Application\page\QuestionAddForm;
use Zend\View\Model\ViewModel;

class QuestionController extends BaseController
{
    public function addAction()
    {
        $this->checkUserIdentity();
        $messages = array();
        $questionAddForm = new QuestionAddForm();
        $config = $this->getConfig();
        $questionAddForm->setAttribute('action', $config['router']['routes']['question-add']['options']['route']);
        $request = $this->getRequest();

        //prefill radars
        $radars = array();
        $radar = $this->getEntityManager()->getRepository('Application\Entity\Radar')->findAll();
        foreach ($radar as $obj) {
            $radars[$obj->getId()] = ucfirst($obj->getName()) . ' Radar';
        }
        $questionAddForm->get('radar')->setAttribute('options', $radars);

        //remove prefilling categories if radars are more than one
        $categories = array();
        $radar = $this->getEntityManager()->find('Application\Entity\Radar', 1);
        $category = $this->getEntityManager()->getRepository('Application\Entity\Category')->findBy(array("radar" => $radar));
        foreach ($category as $obj) {
            $categories[$obj->getId()] = ucfirst($obj->getName());
        }
        $questionAddForm->get('category')->setAttribute('options', $categories);

        if ($request->isPost()) {
            $questionAddForm->setInputFilter(new QuestionAddFilter());
            $questionAddForm->setData($request->getPost());
            if ($questionAddForm->isValid()) {
                $data = $questionAddForm->getData();
                $params = array(
                    Question::FIELD_SUB_CATEGORY => $this->em->find('Application\Entity\Subcategory', $data['subcategory']),
                    Question::FIELD_QUESTION => $data['question']
                );
                $question = new Question();
                $this->setAttributes($question, $params);

                $optionOneParams = array(
                    'question' => $question,
                    'display' => 'Yes',
                    'weightage' => 2
                );
                $this->setAttributes(new Options(), $optionOneParams);

                $optionTwoParams = array(
                    'question' => $question,
                    'display' => 'No',
                    'weightage' => 0
                );
                $this->setAttributes(new Options(), $optionTwoParams);

                $optionThreeParams = array(
                    'question' => $question,
                    'display' => 'Partial',
                    'weightage' => 1
                );
                $this->setAttributes(new Options(), $optionThreeParams);

                $optionFourParams = array(
                    'question' => $question,
                    'display' => 'N/A',
                    'weightage' => -1
                );
                $this->setAttributes(new Options(), $optionFourParams);



                try {
                    $this->em->flush();
                    //redirecting
                    $this->redirect()->toRoute('question-add');
                } catch (\Exception $e) {
                    $this->handleException($e);
                }
            }
        }

        return new ViewModel(array(
            'questionAddForm' => $questionAddForm,
            'messages' => $messages,
        ));
    }

    public function editAction()
    {
        $question = $this->getEntityManager()->find('Application\Entity\Question', 1);
        exit;
    }

    public function updateAction()
    {
        $status = false;
        $id = $this->params()->fromPost('id');
        if ($id) {
            $qString = strip_tags(trim($this->params()->fromPost('question')));
            $question = $this->getEntityManager()->find('Application\Entity\Question', $id);
            $params = array(
                Question::FIELD_QUESTION => $qString
            );
            $this->setAttributes($question, $params);
            try {
                $this->getEntityManager()->flush();
                $status = true;
            } catch (\Exception $e) {
                $this->handleException($e);
            }
        }

        print_r(json_encode($status));
        exit;
    }

    public function listAction()
    {
        $view = array();
        $question = $this->getEntityManager()->getRepository('Application\Entity\Question')->findBy(array(), array("id" => "DESC"));
        //print "<PRE>";
        //var_dump($question);
        //exit;
        foreach ($question as $qObj) {
            $view[] = array(
                'id' =>  $qObj->getId(),
                'question' => ucfirst($qObj->getQuestion()),
                'category' => ucfirst($qObj->getSubcategory()->getCategory()->getName()),
                'subcategory' => ucfirst($qObj->getSubcategory()->getName())
            );
        }
        //print_r($view);exit;
        print_r(json_encode($view));
        exit;
    }

    public function deleteAction()
    {
        $status = false;
        $id = $this->params()->fromPost('id');
        if ($id) {
            $question = $this->getEntityManager()->find('Application\Entity\Question', $id);
            $options = $question->getOptions();
            foreach ($options as $option) {
                $this->getEntityManager()->remove($option);
            }
            $this->getEntityManager()->remove($question);
            try {
                $this->getEntityManager()->flush();
                $status = true;
            } catch (\Exception $e) {
                $this->handleException($e);
            }
        }

        print_r(json_encode($status));
        exit;
    }

    public function listBySubcategoryAction()
    {
        $subcategory = $this->getEntityManager()->find('Application\Entity\Subcategory', 2);
        $question = $this->getEntityManager()->getRepository('Application\Entity\Question')->findBy(array("subcategory" => $subcategory));
    }

    public function getAllRadarsAction()
    {
        $radar = $this->getEntityManager()->getRepository('Application\Entity\Radar')->findAll();
        exit;
    }

    public function getRadarCategoriesAction()
    {
        $radar = $this->getEntityManager()->find('Application\Entity\Radar', 1);
        $category = $this->getEntityManager()->getRepository('Application\Entity\Category')->findBy(array("radar" => $radar));
        exit;
    }

    public function getCategorySubcategoriesAction()
    {
        $category = $this->getEntityManager()->find('Application\Entity\Category', 1);
        $subcategory = $this->getEntityManager()->getRepository('Application\Entity\Subcategory')->findBy(array("category" => $category));
        exit;
    }

    public function getSubcategoryQuestionsAction()
    {
        /*$request = $this->getRequest();
        $subcategory = $this->params()->fromPost('');
        return $this->getEntityManager()->find('Application\Entity\Subcategory', );*/
    }
}
