<?php
namespace Application\Controller;

use Application\Entity\Category;
use Application\Entity\RatingQuarter;
use Application\Entity\Role;
use Application\Entity\Subcategory;
use Zend\Authentication\AuthenticationService;
use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail;
use Zend\Mvc\Controller\AbstractActionController;

class BaseController extends AbstractActionController
{
    /**
     * @var DoctrineORMEntityManager
     */
    protected $em;
    protected $user;

    /** Email Subjects for actions */
    const SUBJECT_COMPANY_CREATED = "GTHA account for your company is created";
    const SUBJECT_TEAM_MEMBER_CREATED = "GTHA account for you is created";

    public function checkUserIdentity()
    {
        //check user authentication
        $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        if ($auth->hasIdentity()) {
            $this->user = $auth->getIdentity();

            //allow, deny users and resources
            $controller = $this->getEvent()->getRouteMatch()->getParam('controller', 'index');
            $controller = explode('\\', $controller);
            $controller = array_pop($controller);
            $userDetails = $this->getEntityManager()->getRepository('Application\Entity\EmployeeDetails')->findOneBy(array("emp" => $this->user->getId()));
            $role = $userDetails->getRole();
            switch ($role->getName()) {
                case Role::HPTA_ADMIN:
                    $deniedControllers = array();
                    $redirectUrl = 'question-add';
                    break;
                case Role::COMPANY_ADMIN:
                    $deniedControllers = array('Question', 'Company');
                    $redirectUrl = 'team-add';
                    break;
                case Role::TEAM_MEMBER:
                    $deniedControllers = array('Question', 'Company', 'Team', 'TeamMember');
                    $redirectUrl = 'survey-radar';
                    break;
                default:
                    $deniedControllers = array('Question', 'Company', 'Team', 'TeamMember', 'Survey');
                    $redirectUrl = 'login';
                    break;
            }
            if (in_array($controller, $deniedControllers)) {
                $this->flashMessenger()->addMessage('Unauthorized access !');
                header("Location: /");
                return $this->redirect()->toRoute($redirectUrl);
            }
        } else {
            $this->flashMessenger()->addMessage('Unauthorized access !');
            header("Location: /");
            return $this->redirect()->toRoute('application');
        }

        $this->layout()->activePage = $controller;
        $this->layout()->categories = $this->getCategoriesAndSubcategories();
    }

    public function getConfig()
    {
        return $this->getServiceLocator()->get('config');
    }

    public function generatePassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        $passLenth = rand(8, 15);

        for ($i = 0; $i < $passLenth; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return 'h6smj@1234';//TODO::Comment this to remove hardcoded value
        return implode($pass); //turn the array into a string
    }

    /*
     * return EntityManager
     */
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    /*
     * param Entity $entity
     * param Array $params
     *
     * return Entity
     */
    public function setAttributes($entity, $params)
    {
        foreach ($params as $attribute => $value) {
            $entity->{'set' . ucfirst($attribute)}($value);
        }

        $this->getEntityManager()->persist($entity);

        return $entity;
    }

    public function handleException($exception)
    {
        error_log($exception->getMessage());
        //TODO : redirect to error page
    }

    public function sendMail($from, $to, $subject, $body)
    {
        //TODO : overriding the actual recepient address, testing purpose only
        $bcc = array('m.shareef@prowareness.nl', 'n.choppa@prowareness.nl');

        $mail = new Message();
        $mail->setBody($body);
        $mail->setFrom($from['email'], $from['name']);
        $mail->addTo($to);
        foreach ($bcc as $email) {
            $mail->addBcc($email);
        }
        $mail->setSubject($subject);

        $transport = new Sendmail();
        //TODO::uncomment sending mail
        //$transport->send($mail);
    }

    public function getMailBody($type, $data)
    {
        $config = $this->getConfig();
        switch ($type)
        {
            case self::SUBJECT_COMPANY_CREATED:
                $body = <<<EOT
Hi {$data['firstname']} {$data['lastname']},

Your GTHA company account is successfully created.
Your account details:

Company : {$data['company']}
Username : {$data['email']}
Password : {$data['password']}

Login here : {$config['hostBaseUrl']}

Thanks,
Team GTHA
EOT;
                break;
            case self::SUBJECT_TEAM_MEMBER_CREATED:
                $body = <<<EOT
Hello {$data['firstname']} {$data['lastname']},

We have been making some progress and gained insights with the interviews and the observations.
To further strengthen our recommendations, we ask for half an hour of your time to fill in the online survey.
Please follow the provided link to find the online survey

{$config['hostBaseUrl']}

Your account details:

Username : {$data['email']}
Password : {$data['password']}

It would help both yourselves and us if you take the survey within a week. Thanks in advance.

Regards,
Team GTHA
EOT;
                break;
            default:
                $body = 'GTHA mail';
                break;
        }
        return $body;
    }

    public function getCategoriesAndSubcategories()
    {
        $categories = array();
        $radar = $this->getEntityManager()->find('Application\Entity\Radar', 1);
        $category = $this->getEntityManager()->getRepository('Application\Entity\Category')->findBy(array(Category::FIELD_RADAR => $radar));
        foreach ($category as $item) {
            $subcategory = $this->getEntityManager()->getRepository('Application\Entity\Subcategory')->findBy(array(Subcategory::FIELD_CATEGORY => $item));
            foreach ($subcategory as $subItem) {
                $categories[$item->getName()]['subcategories'][$subItem->getId()] = array(
                    'status' => $this->getSubcategoryAnswerStatus($subItem->getId()),
                    'name' => $subItem->getName()
                );
            }
            $categories[$item->getName()]['id'] = $item->getId();
            $categories[$item->getName()]['status'] = $this->getCategoryAnswerStatus($item->getId());
        }
        return $categories;
    }

    public function getCategoryAnswerStatus($category)
    {
        $subcategories = $this->getEntityManager()->getRepository('Application\Entity\Subcategory')->findBy(array(Subcategory::FIELD_CATEGORY => $category));
        foreach ($subcategories as $subcategory) {
            if (!$this->getSubcategoryAnswerStatus($subcategory)) {
                return 0;
            }
        }
        return 1;
    }

    public function getSubcategoryAnswerStatus($subcategory)
    {
        $questions = $this->em->getRepository('Application\Entity\Question')->findBy(array('subcategory' => $subcategory));
        $questionsCount = count($questions);
        $answers = $this->em->getRepository('Application\Entity\RatingQuarter')->findBy(array(
            RatingQuarter::FIELD_YEAR => $this->getYear(),
            RatingQuarter::FIELD_QUARTER => $this->getQuarter(),
            RatingQuarter::FIELD_EMPLOYEE => $this->user,
            RatingQuarter::FIELD_QUESTION => $questions,
            RatingQuarter::FIELD_ANSWER => array(-1, 0, 1, 2)
        ));
        $answersCount = count($answers);

        return ($questionsCount == $answersCount) ? 1 : 0;
    }

    public function getYear()
    {
        return date('Y');
    }

    public function getQuarter()
    {
        $month = date('m', time());
        return ceil($month/3);
    }
}
