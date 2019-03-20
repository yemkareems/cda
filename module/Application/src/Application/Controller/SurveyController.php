<?php
namespace Application\Controller;

use Application\Entity\Category;
use Application\Entity\Question;
use Application\Entity\Radar;
use Application\Entity\RatingQuarter;
use Application\Entity\Role;
use Application\page\SurveyFilter;
use Application\page\SurveyForm;
use Application\page\SurveySearchForm;
use Doctrine\ORM\Query\ResultSetMapping;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class SurveyController extends BaseController
{
    public $categoryColors = array(
        Category::CAT_MINDSET => array('#fb4a45', '#e1423e', '#c83b37', '#af3330', '#962c29'),
        Category::CAT_PRACTICES => array('#ffcc00', '#e5b700', '#cca300', '#b28e00', '#997a00'),
        Category::CAT_RELATIONSHIP => array('#4285f4', '#3b77db', '#346ac3', '#2e5daa', '#274f92'),
        Category::CAT_ENVIRONMENT => array('#259c39', '#218c33', '#1d7c2d', '#196d27', '#165d22'),

        Category::CAT_EN_TEAM => array('#fb4a45', '#e1423e', '#c83b37', '#af3330', '#962c29'),
        Category::CAT_AL_TEAM => array('#ffcc00', '#e5b700', '#cca300', '#b28e00', '#997a00'),
        Category::CAT_CF_TEAM => array('#4285f4', '#3b77db', '#346ac3', '#2e5daa', '#274f92', '#204482'),
        Category::CAT_SS_TEAM => array('#259c39', '#218c33', '#1d7c2d', '#196d27', '#165d22'),
        Category::CAT_HP_TEAM => array("#af67ce", "#aa56ce", "#ab2be2", "#a910ea", "#9400D3"),
        Category::CAT_TE_TEAM => array("#eaad70", "#e59a50", "#e58b32", "#e57f1b", "#e5780d", "#FF7F00"),






    );
    public function takeAction()
    {
        $this->checkUserIdentity();
        $messages = array();
        $year = $this->getYear();
        $quarter = $this->getQuarter();
        $status = null;
        $config = $this->getConfig();

        //$surveyForm->setAttribute('action', $config['router']['routes']['survey-take']['options']['route']);

        $subcategoryId = $this->params()->fromRoute('subcategoryId');
        $subcategoryId = (int)$subcategoryId;

        if ($subcategoryId <= 0) {
            return $this->redirect()->toRoute('survey-summary');
        }

        $surveyForm = new SurveyForm($subcategoryId);

        //prepare questions by sub category
        $subCategory = $this->em->getRepository('Application\Entity\Subcategory')->find($subcategoryId);
        $questions = $this->em->getRepository('Application\Entity\Question')->findBy(array("subcategory" => $subcategoryId));

        $totalPageCount = $this->getEntityManager()->getRepository('Application\Entity\Subcategory')->findMax();

        //$questions = array_combine(range(1, count($questions)), array_values($questions));
        //$questions = $questions[$subcategoryId];

        //getting answers
        $answers = array();
        $ratingQuarters = $this->em->getRepository('Application\Entity\RatingQuarter')->findBy(array(
            RatingQuarter::FIELD_YEAR => $year,
            RatingQuarter::FIELD_QUARTER => $quarter,
            RatingQuarter::FIELD_EMPLOYEE => $this->user
        ));


        if ($ratingQuarters) {
            foreach ($ratingQuarters as $rq) {
                $answers[$rq->getQuestion()->getId()] = $rq->getAnswer();
                $comment[$rq->getQuestion()->getId()] = $rq->getComment();
            }
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $postData = $this->params()->fromPost();


            $surveyFilter = new SurveyFilter();
            //setting validation constraints
            foreach ($questions as $question){
                $qName = 'question-'.$question->getId();
                $cName = 'comment-'.$question->getId();

                $surveyFilter->add(array(
                    'name' => $qName,
                    'required' => true,
                ));
                $answers[$question->getId()] = $postData[$qName];
                $comment[$question->getId()] = $postData[$cName];

            }
            //validation
            $surveyForm->setInputFilter($surveyFilter);
            $surveyForm->setData($data);
            $save = false;
            if ($surveyForm->isValid() || isset($postData['save'])) {
                unset($postData['submit']);
                if(isset($postData['save'])) {
                    $save = true;
                }
                unset($postData['save']);
                foreach ($answers as $questionId => $answer) {
                    if (array_key_exists('question-' . $questionId, $postData) || $postData['comment-' . $questionId] != '') {
                        $qComment = $postData['comment-' . $questionId];
                        $question = $this->em->find('Application\Entity\Question', $questionId);
                        //find if answer is already available
                        $ratingQuarter = $this->em->getRepository('Application\Entity\RatingQuarter')->findOneBy(array(
                            RatingQuarter::FIELD_YEAR => $year,
                            RatingQuarter::FIELD_QUARTER => $quarter,
                            RatingQuarter::FIELD_EMPLOYEE => $this->user,
                            RatingQuarter::FIELD_QUESTION => $question
                        ));
                        if (!$ratingQuarter instanceof RatingQuarter) {
                            $ratingQuarter = new RatingQuarter();
                        }
                        if($answer == '') {
                            //only comments are present mark it as revisit(-2) option
                            $answer = -2;
                        }
                        $weightage = $answer;
                        /*
                        if($questionId == 61){
                            //TODO::Reverse weightage question have weightage in question level
                            $weightage = 5 - $answer;
                        }
                        */
                        $params = array(
                            RatingQuarter::FIELD_ANSWER => $answer,
                            RatingQuarter::FIELD_WEIGHTAGE => $weightage,
                            RatingQuarter::FIELD_COMMENT => $qComment,
                            RatingQuarter::FIELD_QUESTION => $question,
                            RatingQuarter::FIELD_DATETIME => new \DateTime(),
                            RatingQuarter::FIELD_EMPLOYEE => $this->user,
                            RatingQuarter::FIELD_YEAR => $year,
                            RatingQuarter::FIELD_QUARTER => $quarter
                        );
                        $this->setAttributes($ratingQuarter, $params);
                        try {
                            //if (($config['allowEdit'] && $ratingQuarter->getId() > 0)  || (!$ratingQuarter->getId() > 0)) {
                            $this->em->flush($ratingQuarter);
                            //}
                            $status = true;
                            if ($subcategoryId < $totalPageCount) {
                                $params['year'] = date("Y");
                                $params['empId'] = $this->user->getId();
                                $month = date('m', time());
                                $params['quarter'] = ceil($month/3);
                                if($save){
                                    $this->redirect()->toRoute('survey-take', array('subcategoryId' => $subcategoryId));
                                } else {
                                    $result = $this->getEntityManager()->getRepository('Application\Entity\RatingQuarter')->findLastSubCategory($params);
                                    $this->redirect()->toRoute('survey-take', array('subcategoryId' => $result));
                                }
                            } else {
                                $this->redirect()->toRoute('survey-summary');
                            }
                        } catch (\Exception $e) {
                            $this->handleException($e);
                        }
                    }
                }
            } else {
                $messages[] = 'Please answer all the questions.';
            }
        } else {
            if($subcategoryId > $totalPageCount){
                return $this->redirect()->toRoute('survey-summary');
            }
        }

        if (!is_null($status)) {
            $messages[] = $status ? 'Changes saved successfully.' : 'Unable to save. Please try again.';
        }

        //refreshing the menu items and its statuses
        $this->layout()->categories = $this->getCategoriesAndSubcategories();
        $previousSid = $this->getEntityManager()->getRepository('Application\Entity\Subcategory')->findPrevious($subCategory->getId());

        return new ViewModel(array(
            'surveyForm' => $surveyForm,
            'formAction' => 'survey-take',
            'messages' => $messages,
            'subcategory' => $subCategory,
            'previous' => $previousSid,
            'totalPageCount' => $totalPageCount,
            'questions' => $questions,
            'answers' => $answers,
            'comment' => $comment,
            'answerOptions' => Question::getAnswerOptions(),
        ));
    }

    public function findAction()
    {

        $answer = $this->em->find('Application\Entity\RatingQuarter', 1);
        //var_dump($answer);
        var_dump($answer->getEmp()->getTeam());
    }

    private function calculateAverage( $arr, $sort )
    {
        $order = array();
        /*
        if($sort == 'graph') {
            $order = array(Category::CAT_PRACTICES, Category::CAT_ENVIRONMENT, Category::CAT_RELATIONSHIP, Category::CAT_MINDSET);
        } elseif($sort == 'radar') {
            $order = array(Category::CAT_MINDSET, Category::CAT_RELATIONSHIP,  Category::CAT_ENVIRONMENT,  Category::CAT_PRACTICES);
        }
        */


        $teamRating = $subcat = $individual = $individualRating = $categoryArr = array();
        foreach($arr as $array) {
            $subcat[$array['category']][$array['subcategory']][] = $array['avg_rating'];
            $individual[$array['emp_id']][$array['category']][$array['subcategory']] = $array['avg_rating'];
            $categoryArr{$array['category']}{$array['subcategory']}['rating'] = $array['avg_rating'];
            $categoryArr{$array['category']}{$array['subcategory']}['total'] = $array['total'];
            $categoryArr{$array['category']}[$array['category']]['rating'] = $categoryArr{$array['category']}[$array['category']]['rating'] + $array['avg_rating'];
            $categoryArr{$array['category']}[$array['category']]['total'] = $categoryArr{$array['category']}[$array['category']]['total'] + $array['total'];
        }
        //ksort($categoryArr);

        foreach ($subcat as $category => $subcategory) {
            foreach ($subcategory as $k => $values) {
                $teamRating[$category][$k] = round(array_sum($values) / count($values), 1) ;
            }
        }

        //add unanswered categories and set to 0 for team and individual
        $categories = $this->getCategoriesAndSubcategories();
        foreach ($categories as $cName => $cData) {
            foreach ($cData['subcategories'] as $sKey => $sData) {
                $sName = $sData['name'];
                if (!isset($teamRating[$cName][$sName])) {
                    $teamRating[$cName][$sName] = 0;
                }
                foreach ($individual as $empId => $category) {
                    foreach ($category as $ecName => $subcategory) {
                        foreach ($subcategory as $esName => $average) {
                            if(!isset($individual[$empId][$cName][$sName])){
                                $individual[$empId][$cName][$sName] = 0;
                            }
                        }
                    }
                }
            }
        }

        //ordering categories for view for team
        $teamRating = array_merge(array_flip($order), $teamRating);

        foreach($individual as $empId => $category){
            $employee = $this->getEntityManager()->getRepository('Application\Entity\Employee')->findOneBy(array('id' => $empId));
            foreach ($category as $cName => $subcategory) {
                foreach ($subcategory as $sName => $average) {
                    $individualRating[$employee->getFullname()."-".$employee->getEmail()][$cName][$sName] = round($average, 1);
                }
            }
        }
        foreach ($individualRating as $employeeInfo => $category) {
            //ordering categories for view for individual
            $individualRating[$employeeInfo] = array_merge(array_flip($order), $category);
        }
        foreach ($individualRating as $employeeInfo => $category) {
            foreach ($category as $ecName => $subcategory) {
                //ordering sub categories for view for individual
                $subcategory = array_merge(array_flip(array_keys($teamRating[$ecName])), $subcategory);
                $individualRating[$employeeInfo][$ecName] = $subcategory;
            }
        }
        return array("teamRating" => $teamRating, "individualRating" => $individualRating, 'categoryArr' => $categoryArr);
    }

    private function findAnswersByTeamAction($params)
    {
        $params['year'] = isset($params['year']) ? $params['year'] : $this->getYear();
        $params['quarter'] = isset($params['quarter']) ? $params['quarter'] : $this->getQuarter();
        $params['radarType'] = Radar::TYPE_TEAM;
        $result = $this->getEntityManager()->getRepository('Application\Entity\RatingQuarter')->findAnswersByTeamAction($params);
        return $this->calculateAverage($result, $params['type']);
    }

    private function getDeviationBySubCategory($summary) {
        $sdBySubCategory = array();
        foreach ($summary as $category => $subCategory) {
            foreach ($subCategory as $sname => $qDetails) {
                foreach ($qDetails as $question) {
                    $sdBySubCategory[$sname]['sd_sum']+=$question['standard_deviation'];
                    $sdBySubCategory[$sname]['average']+=$sdBySubCategory[$sname]['sd_sum']/count($subCategory[$sname]);

                }

            }
        }
        uasort($sdBySubCategory,function ($a, $b)
        {
            return $a["average"] > $b["average"] ? -1 : ($a["average"] === $b["average"] ? 0 : 1);
        });
        return $sdBySubCategory;

    }

    private function getDeviationGraphData($summary) {
        $sdBySubCategory = array();
        foreach ($summary as $category => $subCategory) {
            foreach ($subCategory as $sname => $qDetails) {
                foreach ($qDetails as $question) {
                    $sdBySubCategory[$sname]['sd_sum']+=$question['standard_deviation'];
                    $sdBySubCategory[$sname]['average']+=$sdBySubCategory[$sname]['sd_sum']/count($subCategory[$sname]);

                }

            }
        }
        uasort($sdBySubCategory,function ($a, $b)
        {
            return $a["average"] > $b["average"] ? -1 : ($a["average"] === $b["average"] ? 0 : 1);
        });
        return $sdBySubCategory;

    }

    private function stats_standard_deviation(array $a, $sample = false) {
        $n = count($a);
        if ($n === 0) {
            trigger_error("The array has zero elements", E_USER_WARNING);
            return false;
        }
        if ($sample && $n === 1) {
            trigger_error("The array has only 1 element", E_USER_WARNING);
            return false;
        }
        $mean = array_sum($a) / $n;
        $carry = 0.0;
        foreach ($a as $val) {
            $d = ((double) $val) - $mean;
            $carry += $d * $d;
        };
        if ($sample) {
            --$n;
        }
        return sqrt($carry / $n);
    }

    private function getStrengthWeaknessSummary($params){
        $params['year'] = isset($params['year']) ? $params['year'] : $this->getYear();
        $params['quarter'] = isset($params['quarter']) ? $params['quarter'] : $this->getQuarter();
        $params['radarType'] = Radar::TYPE_TEAM;

        $summary = array();
        $strengthsAndWeakness = $this->getEntityManager()->getRepository('Application\Entity\RatingQuarter')->getStrengthWeaknessSummary($params);
        foreach ($strengthsAndWeakness as $details) {
            $summary{$details['category']}[$details{'subcategory'}]{$details['qid']}['question'] = $details['question'];
            $summary{$details['category']}[$details{'subcategory'}]{$details['qid']}['rating_count']++;
            $summary{$details['category']}[$details{'subcategory'}]{$details['qid']}['total_rating'] += $details['rating'];
            $summary{$details['category']}[$details{'subcategory'}]{$details['qid']}['individual_rating'][]= $details['rating'];
            $summary{$details['category']}[$details{'subcategory'}]{$details['qid']}['individual_rating_count'][round($details['rating'])]++;
            $summary{$details['category']}[$details{'subcategory'}]{$details['qid']}['category'] = $details['category'];
            $summary{$details['category']}[$details{'subcategory'}]{$details['qid']}['subcategory'] = $details['subcategory'];

            $summary{$details['category']}[$details{'subcategory'}]{$details['qid']}['standard_deviation'] = self::stats_standard_deviation($summary{$details['category']}[$details{'subcategory'}]{$details['qid']}['individual_rating']);
        }
        //print "<PRE>";print_r($summary);exit;
        return $summary;
    }

    private function checkUserAllowed($teamId) {
        $role = $this->user->getEmployeeDetails()->getRole()->getName();
        $isAllowed = false;
        switch ($role) {
            case Role::COMPANY_ADMIN:
                $isAllowed = true;
                break;
            case Role::TEAM_MEMBER:
                $isAllowed = ($teamId == $this->user->getEmployeeTeam()->getId()) ? true : false;
                break;
            default:
                $isAllowed = false;
                break;
        }
        return $isAllowed;
    }

    public function radarAction()
    {
        $messages = array();
        $this->checkUserIdentity();
        $teamId = $this->params()->fromRoute('teamId');
        if(!$teamId) {
            $teamId = $this->user->getEmployeeTeam()->getId();
        }

        $isAllowed = $this->checkUserAllowed($teamId);
        $surveySearchForm = new SurveySearchForm();
        $queryParams = array(
            'teamId' => $teamId,
            'type' => 'radar',
            'quarter' => $this->getQuarter()
        );
        $surveySearchForm->get('quarter')->setValue($this->getQuarter());
        //searching
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $surveySearchForm->setData($data);
            $queryParams['year'] = $data->year;
            $queryParams['quarter'] = $data->quarter;
        }
        $resultsByTeam = array();
        if($isAllowed) {
            $resultsByTeam = $this->findAnswersByTeamAction($queryParams);
        } else {
            $messages[] = "Unauthorized";
        }
        $result = array();
        $legends[] = "Team";
        $categoryColors = $this->categoryColors;
        $fillcolor = array();
        $fillcolor[0] = "#ea4335";
        $fillcolor[1] = "#ea4335";
        $fillcolor[2] = "#e08128";
        $fillcolor[3] = "#fbbc05";
        $fillcolor[4] = "#34a853";
        $fillcolor[5] = "#34a853";
        $divident = 25;


        $categoryColors = $this->categoryColors;
        if($resultsByTeam) {
           $newArray = array();
           foreach ($resultsByTeam['teamRating'] as $categoryName => $subcategory) {
               foreach ($subcategory as $subcategoryName => $rating) {
                   $total = $resultsByTeam['categoryArr'][$categoryName][$subcategoryName]['total'];
                   $percentage = ($rating * 100) / $total;
                   $newArray[$categoryName]['percentage'][] = $percentage;
                   $newArray[$categoryName]['rating'][] = $rating;
                   $newArray[$categoryName]['total'][] = $total;
               }
           }
            $i = 0;
            foreach ($newArray as $category => $values) {
                $percent = (array_sum($values['rating'])/array_sum($values['total']))*100;
                $outOfFive = round($percent/20,1);
                $key = ceil($percent/$divident);
                $color = $fillcolor[$key];
                $result[$i][] = array(
                    "axis" => ucfirst($category),
                    "value" => $outOfFive,
                    "color" => $color
                );
            }
            $i++;
            /*find previous quarters results */
            if($queryParams['quarter'] == 1) {
                $queryParams['quarter'] = 4;
                $queryParams['year'] = $queryParams['year'] - 1;
            } else {
                $queryParams['quarter'] = $queryParams['quarter'] - 1;
            }


            $previousQuarterResults = $this->findAnswersByTeamAction($queryParams);

            $prevQuarterArray = array();
            foreach ($previousQuarterResults['teamRating'] as $categoryName => $subcategory) {
                foreach ($subcategory as $subcategoryName => $rating) {
                    $total = $previousQuarterResults['categoryArr'][$categoryName][$subcategoryName]['total'];
                    $percentage = ($rating * 100) / $total;
                    $prevQuarterArray[$categoryName]['percentage'][] = $percentage;
                    $prevQuarterArray[$categoryName]['rating'][] = $rating;
                    $prevQuarterArray[$categoryName]['total'][] = $total;
                }
            }

            foreach ($prevQuarterArray as $category => $values) {
                $percent = 0;
                if(array_sum($values['rating'])) {
                    $percent = (array_sum($values['rating']) / array_sum($values['total'])) * 100;
                }
                if($percent)
                    $outOfFive = round($percent/20,1);
                else
                    $outOfFive = 0;


                $key = ceil($percent/$divident);
                $color = $fillcolor[$key];
                $result[$i][] = array(
                    "axis" => ucfirst($category),
                    "value" => $outOfFive,
                    "color" => $color
                );
            }



        }


        if(!$result){
            $messages[] = 'No result found for survey';
        }
        return new ViewModel(array(
            'surveySearchForm' => $surveySearchForm,
            'formAction' => 'survey-radar',
            'user' => $this->user,
            'team' => $this->getEntityManager()->getRepository('Application\Entity\Team')->findOneBy(array("id" => $teamId)),

            'result' => json_encode($result),
            'legends' => json_encode($legends),
            'messages' => $messages,
            'swot' => $this->getTeamSwot($queryParams)
        ));
    }

    public function graphAction()
    {
        $messages = array();
        $this->checkUserIdentity();
        $teamId = $this->params()->fromRoute('teamId');
        if(!$teamId) {
            $teamId = $this->user->getEmployeeTeam()->getId();
        }

        $surveySearchForm = new SurveySearchForm();
        $queryParams = array(
            'teamId' => $teamId,
            'type' => 'graph',
            'quarter' => $this->getQuarter()
        );
        $surveySearchForm->get('quarter')->setValue($this->getQuarter());
        //searching
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $surveySearchForm->setData($data);
            $queryParams['year'] = $data->year;
            $queryParams['quarter'] = $data->quarter;
        }

        $result = array();

        return new ViewModel(array(
            'surveySearchForm' => $surveySearchForm,
            'formAction' => 'survey-graph',
            'result' => json_encode($result),
            'messages' => $messages,
            'user' => $this->user,
            'team' => $this->getEntityManager()->getRepository('Application\Entity\Team')->findOneBy(array("id" => $teamId)),
            'swot' => $this->getTeamSwot($queryParams)
        ));
    }

    public function graphCsvAction()
    {
        $this->checkUserIdentity();
        $teamId = $this->params()->fromRoute('teamId');
        $year = $this->params()->fromRoute('year');
        $quarter = $this->params()->fromRoute('quarter');
        if(!$teamId) {
            $teamId = $this->user->getEmployeeTeam()->getId();
        }

        $queryParams = array(
            'teamId' => $teamId,
            'type' => 'graph',
            'year' => $year,
            'quarter' => $quarter
        );
        $isAllowed = $this->checkUserAllowed($teamId);
        $resultsByTeam = array();
        if($isAllowed) {
            $resultsByTeam = $this->findAnswersByTeamAction($queryParams);
        }

        //preparing chart colors for categories
        $categories = $this->getCategoriesAndSubcategories();
        $categoryColors = $this->categoryColors;
        $colors = array();
        foreach ($categories as $cName => $cDetails) {
            $i = 0;
            foreach ($cDetails['subcategories'] as $sId => $sDetails) {
                $sName = ucfirst($sDetails['name']);
                $colors[$sName] = $categoryColors[$cName][$i];
                $i++;
            }
        }

        $csv = "id,order,score,weight,color,label,rating,total,category\n";
        if($isAllowed && $resultsByTeam) {

            $fillcolor = array();
            $fillcolor[0] = "#ea4335";
            $fillcolor[1] = "#ea4335";
            $fillcolor[2] = "#e08128";
            $fillcolor[3] = "#fbbc05";
            $fillcolor[4] = "#34a853";
            $fillcolor[5] = "#34a853";
            $divident = 25;

            //Start : Code to regenerated the Not Applicable (N/A) values from answers
            $categories = $this->getCategoriesAndSubcategories();
            $categoryArr = array();
            foreach ($categories as $cat => $sCats) {
                foreach ($sCats['subcategories'] as $sKey => $sCat) {
                    if (!isset($resultsByTeam['categoryArr'][$cat][$sCat{'name'}])) {
                        $categoryArr[$cat][$sCat{'name'}] = array(
                            'rating' => 0,
                            'total' => 0
                        );
                    } else {
                        $categoryArr[$cat][$sCat{'name'}] = $resultsByTeam['categoryArr'][$cat][$sCat{'name'}];
                    }
                }
            }
            $resultsByTeam['categoryArr'] = $categoryArr;
            //End : Code to regenerated the Not Applicable (N/A) values from answers

            foreach ($resultsByTeam['categoryArr'] as $category => $catValues) {
                foreach ($catValues as $subcategory => $subCatValues) {
                    if($category != $subcategory) {
                        $subcategory = ucfirst($subcategory);

                        $percentage = ($subCatValues['rating'] * 100) / $subCatValues['total'];
                        $key = ceil($percentage/$divident);
                        $color = $fillcolor[$key];
                        $subCatValues['rating'] = floor($subCatValues['rating']) == $subCatValues['rating'] ? floor($subCatValues['rating']) : $subCatValues['rating'];
                        if($subCatValues['rating']) {
                            $val = round(($subCatValues['rating']*100) /$subCatValues['total'] , 2);
                        } else {
                            $val = 0;
                        }
                        $csv .= "1,1,". $val .",1,$color," . $subcategory . ",".$subCatValues['rating'].",".$subCatValues['total']."," . $category ."\n";
                    }
                }
            }
        }


        //print nl2br($csv);exit;
        print $csv;exit;
    }

    public function barGraphAction()
    {
        $messages = array();
        $this->checkUserIdentity();
        $teamId = $this->params()->fromRoute('teamId');
        if(!$teamId) {
            $teamId = $this->user->getEmployeeTeam()->getId();
        }

        $surveySearchForm = new SurveySearchForm();
        $queryParams = array(
            'teamId' => $teamId,
            'type' => 'graph',
            'quarter' => $this->getQuarter()
        );
        $surveySearchForm->get('quarter')->setValue($this->getQuarter());
        //searching
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $surveySearchForm->setData($data);
            $queryParams['year'] = $data->year;
            $queryParams['quarter'] = $data->quarter;
        }

        $result = array();

        return new ViewModel(array(
            'surveySearchForm' => $surveySearchForm,
            'formAction' => 'survey-graph',
            'result' => json_encode($result),
            'messages' => $messages,
            'user' => $this->user,
            'team' => $this->getEntityManager()->getRepository('Application\Entity\Team')->findOneBy(array("id" => $teamId)),
            'swot' => $this->getTeamSwot($queryParams)
        ));
    }

    public function barGraphCsvAction()
    {
        $this->checkUserIdentity();
        $teamId = $this->params()->fromRoute('teamId');
        $year = $this->params()->fromRoute('year');
        $quarter = $this->params()->fromRoute('quarter');
        if(!$teamId) {
            $teamId = $this->user->getEmployeeTeam()->getId();
        }

        $queryParams = array(
            'teamId' => $teamId,
            'type' => 'graph',
            'year' => $year,
            'quarter' => $quarter
        );
        $isAllowed = $this->checkUserAllowed($teamId);
        $resultsByTeam = array();
        if($isAllowed) {
            $resultsByTeam = $this->findAnswersByTeamAction($queryParams);
        }

        //preparing chart colors for categories
        $categories = $this->getCategoriesAndSubcategories();
        $categoryColors = $this->categoryColors;
        $colors = array();
        foreach ($categories as $cName => $cDetails) {
            $i = 0;
            foreach ($cDetails['subcategories'] as $sId => $sDetails) {
                $sName = ucfirst($sDetails['name']);
                $colors[$sName] = $categoryColors[$cName][$i];
                $i++;
            }
        }

        //print "<PRE>";print_r($resultsByTeam);exit;
        $csv = "date,value,fillcolor\n";
        /*
        $fillcolor[0] = "grey";
        $fillcolor[1] = "#1AA7B8";
        $fillcolor[2] = "#d6ac04";
        $fillcolor[3] = "#8b992c";
        $fillcolor[4] = "#2c9e6b";
        */

        $fillcolor = array();
        $fillcolor[0] = "#ea4335";
        $fillcolor[1] = "#ea4335";
        $fillcolor[2] = "#e08128";
        $fillcolor[3] = "#fbbc05";
        $fillcolor[4] = "#34a853";
        $fillcolor[5] = "#34a853";
        $divident = 25;



        foreach ($resultsByTeam['categoryArr'] as $category => $catValues) {
            foreach ($catValues as $subcategory => $subCatValues) {
                if($category == $subcategory) {
                    if($subCatValues['rating']>=1 && $subCatValues['rating']<=3)
                    {
                        $fill = $fillcolor[0];
                    }elseif($subCatValues['rating']>=4 && $subCatValues['rating']<=6)
                    {
                        $fill = $fillcolor[1];
                    }elseif($subCatValues['rating']>=7 && $subCatValues['rating']<=10)
                    {
                        $fill = $fillcolor[2];
                    }elseif($subCatValues['rating']>=11 && $subCatValues['rating']<=14)
                    {
                        $fill = $fillcolor[3];
                    }else{
                        $fill = $fillcolor[4];
                    }

                    $percentage = ($subCatValues['rating'] * 100) / $subCatValues['total'];
                    $key = ceil($percentage/$divident);
                    $fill = $fillcolor[$key];


                    $csv .= $category . ',' . ($percentage * 1) .",".$fill. "\n";
                }

            }


        }
        print $csv;exit;

    }


    public function summaryAction()
    {
        $this->checkUserIdentity();
        $teamId = $this->params()->fromRoute('teamId');
        $year = $this->params()->fromRoute('year');
        $quarter = $this->params()->fromRoute('quarter');
        if(!$teamId) {
            $teamId = $this->user->getEmployeeTeam()->getId();
        }

        $queryParams = array(
            'teamId' => $teamId,
            'type' => 'graph',
            'year' => $year,
            'quarter' => $quarter
        );
        $surveySearchForm = new SurveySearchForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $surveySearchForm->setData($data);
            $queryParams['year'] = $data->year;
            $queryParams['quarter'] = $data->quarter;
        }

        $isAllowed = $this->checkUserAllowed($teamId);
        $resultsByTeam = array();
        if($isAllowed) {
            $resultsByTeam = $this->findAnswersByTeamAction($queryParams);
        }


        $result = array();
        $surveySearchForm = new SurveySearchForm();

        $surveySearchForm->get('quarter')->setValue($this->getQuarter());
        //searching
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $surveySearchForm->setData($data);
            $queryParams['year'] = $data->year;
            $queryParams['quarter'] = $data->quarter;
        }

        foreach ($resultsByTeam['categoryArr'] as $category => $catValues) {
            foreach ($catValues as $subcategory => $subCatValues) {
                if($category == $subcategory) {
                    unset($resultsByTeam['categoryArr'][$category][$subcategory]);
                }
            }
        }

        //Start : Code to regenerated the Not Applicable (N/A) values from answers
        $categories = $this->getCategoriesAndSubcategories();
        $categoryArr = array();
        foreach ($categories as $cat => $sCats) {
            foreach ($sCats['subcategories'] as $sKey => $sCat) {
                if (!isset($resultsByTeam['categoryArr'][$cat][$sCat{'name'}])) {
                    $categoryArr[$cat][$sCat{'name'}] = array(
                        'rating' => 0,
                        'total' => 0
                    );
                } else {
                    $categoryArr[$cat][$sCat{'name'}] = $resultsByTeam['categoryArr'][$cat][$sCat{'name'}];
                }
            }
        }
        $resultsByTeam['categoryArr'] = $categoryArr;
        //End : Code to regenerated the Not Applicable (N/A) values from answers



        return new ViewModel(array(
            'surveySearchForm' => $surveySearchForm,
            'user' => $this->user,
            'formAction' => 'survey-graph',
            'result' => $resultsByTeam['categoryArr'],
            'team' => $this->getEntityManager()->getRepository('Application\Entity\Team')->findOneBy(array("id" => $teamId)),
            'swot' => $this->getTeamSwot($queryParams)
        ));

    }




    public function graphCsvStrengthAction()
    {
        $this->checkUserIdentity();
        $teamId = $this->params()->fromRoute('teamId');
        $year = $this->params()->fromRoute('year');
        $quarter = $this->params()->fromRoute('quarter');
        if(!$teamId) {
            $teamId = $this->user->getEmployeeTeam()->getId();
        }

        $queryParams = array(
            'teamId' => $teamId,
            'type' => 'graph',
            'year' => $year,
            'quarter' => $quarter
        );
        $isAllowed = $this->checkUserAllowed($teamId);
        $resultsByTeam = array();
        if($isAllowed) {
            $resultsByTeam = $this->findAnswersByTeamAction($queryParams);
        }

        $categoryArr = $resultsByTeam['categoryArr'];
        foreach ($categoryArr as $level => $category) {
            foreach ($category as $subCategories) {
                foreach ($subCategories as $subCategory => $ratings) {
                    $subCategoryAverages[$subCategory] = array_sum($ratings['rating']) / count($ratings['rating']);
                }
            }
        }
        arsort($subCategoryAverages);
        $strengths = array_chunk($subCategoryAverages, 5, 1);
        $strengths = $strengths[0];


        //preparing chart colors for categories
        $categories = $this->getCategoriesAndSubcategories();
        $categoryColors = $this->categoryColors;
        $colors = array();
        foreach ($categories as $cName => $cDetails) {
            $i = 0;
            foreach ($cDetails['subcategories'] as $sId => $sDetails) {
                $sName = ucfirst($sDetails['name']);
                $colors[$sName] = $categoryColors[$cName][$i];
                $i++;
            }
        }

        $csv = "id,order,score,weight,color,label\n";
        if($isAllowed && $resultsByTeam) {
            foreach ($resultsByTeam['teamRating'] as $category) {
                foreach ($category as $subcategory => $rating) {
                    if(array_key_exists($subcategory, $strengths)) {
                        $color = "#2ca02c";
                    } else {
                        $color = "#ccc";
                    }

                    $subcategory = ucfirst($subcategory). "  (".$rating.")";

                    $csv .= "1,1,$rating,1,$color," . $subcategory . "\n";
                }
            }
        }
        print $csv;exit;
    }

    public function graphCsvWeaknessAction()
    {
        $this->checkUserIdentity();
        $teamId = $this->params()->fromRoute('teamId');
        $year = $this->params()->fromRoute('year');
        $quarter = $this->params()->fromRoute('quarter');
        if(!$teamId) {
            $teamId = $this->user->getEmployeeTeam()->getId();
        }

        $queryParams = array(
            'teamId' => $teamId,
            'type' => 'graph',
            'year' => $year,
            'quarter' => $quarter
        );
        $isAllowed = $this->checkUserAllowed($teamId);
        $resultsByTeam = array();
        if($isAllowed) {
            $resultsByTeam = $this->findAnswersByTeamAction($queryParams);
        }

        $categoryArr = $resultsByTeam['categoryArr'];
        foreach ($categoryArr as $level => $category) {
            foreach ($category as $subCategories) {
                foreach ($subCategories as $subCategory => $ratings) {
                    $subCategoryAverages[$subCategory] = array_sum($ratings['rating']) / count($ratings['rating']);
                }
            }
        }
        asort($subCategoryAverages);
        $strengths = array_chunk($subCategoryAverages, 5, 1);
        $strengths = $strengths[0];


        //preparing chart colors for categories
        $categories = $this->getCategoriesAndSubcategories();
        $categoryColors = $this->categoryColors;
        $colors = array();
        foreach ($categories as $cName => $cDetails) {
            $i = 0;
            foreach ($cDetails['subcategories'] as $sId => $sDetails) {
                $sName = ucfirst($sDetails['name']);
                $colors[$sName] = $categoryColors[$cName][$i];
                $i++;
            }
        }

        $csv = "id,order,score,weight,color,label\n";
        if($isAllowed && $resultsByTeam) {
            foreach ($resultsByTeam['teamRating'] as $category) {
                foreach ($category as $subcategory => $rating) {

                    if(array_key_exists($subcategory, $strengths)) {
                        $color = "#d62728";
                    } else {
                        $color = "#ccc";
                    }

                    $subcategory = ucfirst($subcategory). "  (".$rating.")";

                    $csv .= "1,1,$rating,1,$color," . $subcategory . "\n";
                }
            }
        }
        print $csv;exit;
    }


    public function treeAction()
    {
        $messages = array();
        $this->checkUserIdentity();
        $teamId = $this->params()->fromRoute('teamId');
        if(!$teamId) {
            $teamId = $this->user->getEmployeeTeam()->getId();
        }

        $surveySearchForm = new SurveySearchForm();
        $queryParams = array(
            'teamId' => $teamId,
            'type' => 'graph',
            'quarter' => $this->getQuarter()
        );
        $surveySearchForm->get('quarter')->setValue($this->getQuarter());
        //searching
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $surveySearchForm->setData($data);
            $queryParams['year'] = $data->year;
            $queryParams['quarter'] = $data->quarter;
        }

        $result = array();
        return new ViewModel(array(
            'surveySearchForm' => $surveySearchForm,
            'formAction' => 'survey-tree',
            'result' => json_encode($result),
            'messages' => $messages,
            'user' => $this->user,
            'team' => $this->getEntityManager()->getRepository('Application\Entity\Team')->findOneBy(array("id" => $teamId)),
            'swot' => $this->getTeamSwot($queryParams)
        ));
    }

    public function reportAction() {
        $this->checkUserIdentity();
        $teamId = $this->params()->fromRoute('teamId');
        $year = $this->params()->fromRoute('year');
        $quarter = $this->params()->fromRoute('quarter');
        if(!$teamId) {
            $teamId = $this->user->getEmployeeTeam()->getId();
        }

        $surveySearchForm = new SurveySearchForm();
        $queryParams = array(
            'teamId' => $teamId,
            'type' => 'radar',
            'quarter' => $this->getQuarter()
        );
        $surveySearchForm->get('quarter')->setValue($this->getQuarter());
        //searching
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $surveySearchForm->setData($data);
            $queryParams['year'] = $data->year;
            $queryParams['quarter'] = $data->quarter;
        }

        $isAllowed = $this->checkUserAllowed($teamId);
        $resultsByTeam = array();
        if($isAllowed) {
            $resultsByTeam = $this->findAnswersByTeamAction($queryParams);
        }

        $strengthWeaknessSummary = $this->getStrengthWeaknessSummary($queryParams);

        $deviationSummaryBySubCategory = $this->getDeviationBySubCategory($strengthWeaknessSummary);


        //print "<PRE>";print_r($deviationSummaryBySubCategory);print_r($strengthWeaknessSummary);exit;
        $result = array();
        $legends[] = "Team";
        $categoryColors = $this->categoryColors;
        $i = 0;

        if($resultsByTeam) {

            $differences = array_chunk($deviationSummaryBySubCategory, 5, 1);
            $differences = $differences[0];

            //Team
            foreach ($resultsByTeam['teamRating'] as $cName => $subcategory) {
                //$subcategory = array_reverse($subcategory);
                $topKD = false;
                foreach ($subcategory as $sName => $rating) {
                    $color = array_key_exists($sName, $differences) ? "red" : "green";
                    $result[$i][] = array(
                        "axis" => ucfirst($sName),
                        "value" => $rating,
                        "color" => $color
                    );
                }
            }
            $i++;
            //print "<PRE>";
            //Individual
            foreach ($resultsByTeam['individualRating'] as $employeeInfo => $category) {
                $info = explode("-", $employeeInfo);
                $legends[] = $info[0];
                foreach ($category as $cName => $subcategory) {
                    //$subcategory = array_reverse($subcategory);
                    foreach ($subcategory as $sName => $rating) {
                        //print_r($subcategory);
                        $result[$i][] = array(
                            "axis" => ucfirst($sName),
                            "value" => $rating,
                            "color" => $categoryColors[$cName][3]
                        );
                    }
                }
                $i++;
            }
        }

        return new ViewModel(array(
            'result' => json_encode($result),
            'legends' => json_encode($legends),
            'strengthWeaknessSummary' => $strengthWeaknessSummary,
            'deviationSummaryBySubCategory' => $deviationSummaryBySubCategory,
            'answerOptions' => Question::getAnswerOptions(),
            'teamLevels' => $resultsByTeam['teamLevels'],
            'categoryArr' => $resultsByTeam['categoryArr'],
            'team' => $this->getEntityManager()->getRepository('Application\Entity\Team')->findOneBy(array("id" => $teamId)),
        ));

    }

    public function analyzeAction()
    {
        $this->checkUserIdentity();
        $messages = array();
        $year = $this->getYear();
        $quarter = $this->getQuarter();
        $teamId = $this->params()->fromRoute('teamId');
        $teamObj = $this->getEntityManager()->getRepository('Application\Entity\Team')->findOneBy(array('id' => $teamId));
        $empObj = $this->getEntityManager()->getRepository('Application\Entity\EmployeeTeam')->findBy(array('team' => $teamObj));
        $employee = array();
        $empDetail = array();
        foreach ($empObj as $k => $obj) {
            $employee[] =  $obj->getEmp()->getId();
            $empDetail[$obj->getEmp()->getId()] = $obj->getEmp()->getFullName();
        }
        $surveySearchForm = new SurveySearchForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $surveySearchForm->setData($data);
            $year = $data->year;
            $quarter = $data->quarter;
        }


        //$userId = (int)$this->params()->fromRoute('userId');
        //$user = $this->getEntityManager()->getRepository('Application\Entity\Employee')->findOneBy(array('id' => $userId));

        //prepare questions by sub category
        $options = $this->em->getRepository('Application\Entity\Options')->findAll();

        $opts = array();
        if ($options) {
            foreach ($options as $opt) {
                $opts[$opt->getQuestion()->getId()][$opt->getWeightage()] = $opt->getDisplay();
            }
        }


        //getting answers
        $categories = $this->getCategoriesAndSubcategories();
        $subcategories = $answers = $comments = array();
        $questions = $this->em->getRepository('Application\Entity\Question')->findAll();

        foreach($employee as $k => $eid) {
            $ratingQuarters = $this->em->getRepository('Application\Entity\RatingQuarter')->findBy(array(
                RatingQuarter::FIELD_YEAR => $year,
                RatingQuarter::FIELD_QUARTER => $quarter,
                RatingQuarter::FIELD_EMPLOYEE => $eid
            ));

            if ($ratingQuarters) {
                foreach ($ratingQuarters as $rq) {
                    $answers[$rq->getQuestion()->getId()][$eid] = $opts[$rq->getQuestion()->getId()][$rq->getAnswer()];
                    $comments[$rq->getQuestion()->getId()][$eid] = $rq->getComment();
                }
            }
        }


        foreach ($questions as $question) {
            $subcategories[$question->getSubcategory()->getId()]['name'] = $question->getSubcategory()->getName();
            $subcategories[$question->getSubcategory()->getId()]['questions'][$question->getId()] = $question->getQuestion();
        }
        return new ViewModel(array(
            'formAction' => 'generate-analyze',
            'surveySearchForm' => $surveySearchForm,
            'user' => $this->user,
            'team' => $this->getEntityManager()->getRepository('Application\Entity\Team')->findOneBy(array("id" => $teamId)),
            'messages' => $messages,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'questions' => $questions,
            'answers' => $answers,
            'comments' => $comments,
            'empDetail' => $empDetail
        ));

    }

    public function summaryReportAction() {
        $this->checkUserIdentity();
        $teamId = $this->params()->fromRoute('teamId');
        $year = $this->params()->fromRoute('year');
        $quarter = $this->params()->fromRoute('quarter');
        if(!$teamId) {
            $teamId = $this->user->getEmployeeTeam()->getId();
        }

        $surveySearchForm = new SurveySearchForm();
        $queryParams = array(
            'teamId' => $teamId,
            'type' => 'radar',
            'quarter' => $this->getQuarter()
        );
        $surveySearchForm->get('quarter')->setValue($this->getQuarter());
        //searching
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $surveySearchForm->setData($data);
            $queryParams['year'] = $data->year;
            $queryParams['quarter'] = $data->quarter;
        }

        $isAllowed = $this->checkUserAllowed($teamId);
        $resultsByTeam = array();
        if($isAllowed) {
            $resultsByTeam = $this->findAnswersByTeamAction($queryParams);
        }

        $strengthWeaknessSummary = $this->getStrengthWeaknessSummary($queryParams);

        $deviationSummaryBySubCategory = $this->getDeviationBySubCategory($strengthWeaknessSummary);


        //print "<PRE>";print_r($deviationSummaryBySubCategory);print_r($strengthWeaknessSummary);exit;
        $result = array();
        $legends[] = "Team";
        $categoryColors = $this->categoryColors;
        $i = 0;

        if($resultsByTeam) {

            $differences = array_chunk($deviationSummaryBySubCategory, 5, 1);
            $differences = $differences[0];

            //Team
            foreach ($resultsByTeam['teamRating'] as $cName => $subcategory) {
                //$subcategory = array_reverse($subcategory);
                $topKD = false;
                foreach ($subcategory as $sName => $rating) {
                    $color = array_key_exists($sName, $differences) ? "red" : "green";
                    $result[$i][] = array(
                        "axis" => ucfirst($sName),
                        "value" => $rating,
                        "color" => $color
                    );
                }
            }
            $i++;
            //print "<PRE>";
            //Individual
            foreach ($resultsByTeam['individualRating'] as $employeeInfo => $category) {
                $info = explode("-", $employeeInfo);
                $legends[] = $info[0];
                foreach ($category as $cName => $subcategory) {
                    //$subcategory = array_reverse($subcategory);
                    foreach ($subcategory as $sName => $rating) {
                        //print_r($subcategory);
                        $result[$i][] = array(
                            "axis" => ucfirst($sName),
                            "value" => $rating,
                            "color" => $categoryColors[$cName][3]
                        );
                    }
                }
                $i++;
            }
        }

        return new ViewModel(array(
            'result' => json_encode($result),
            'legends' => json_encode($legends),
            'strengthWeaknessSummary' => $strengthWeaknessSummary,
            'deviationSummaryBySubCategory' => $deviationSummaryBySubCategory,
            'answerOptions' => Question::getAnswerOptions(),
            'teamLevels' => $resultsByTeam['teamLevels'],
            'categoryArr' => $resultsByTeam['categoryArr'],
            'team' => $this->getEntityManager()->getRepository('Application\Entity\Team')->findOneBy(array("id" => $teamId)),
        ));

    }

    function array_sort($array, $on, $order=SORT_ASC){

        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }

    public function treeJsonAction()
    {
        $messages = array();
        $this->checkUserIdentity();
        $teamId = $this->params()->fromRoute('teamId');
        $year = $this->params()->fromRoute('year');
        $quarter = $this->params()->fromRoute('quarter');
        if(!$teamId) {
            $teamId = $this->user->getEmployeeTeam()->getId();
        }

        $queryParams = array(
            'teamId' => $teamId,
            'type' => 'graph',
            'year' => $year,
            'quarter' => $quarter
        );
        $isAllowed = $this->checkUserAllowed($teamId);
        $resultsByTeam = array();
        if($isAllowed) {
            $resultsByTeam = $this->findAnswersByTeamAction($queryParams);
        }

        $result = array();
        $team = $this->getEntityManager()->getRepository('Application\Entity\Team')->findOneBy(array('id' => $teamId), array("id" => "DESC"));

        $result['name'] = $team->getName();

        $fillcolor = array();
        $fillcolor[0] = "#ea4335";
        $fillcolor[1] = "#ea4335";
        $fillcolor[2] = "#e08128";
        $fillcolor[3] = "#fbbc05";
        $fillcolor[4] = "#34a853";
        $fillcolor[5] = "#34a853";
        $divident = 25;


        $categoryColors = $this->categoryColors;
        if($resultsByTeam) {
           foreach ($resultsByTeam['teamRating'] as $categoryName => $subcategory) {
               foreach ($subcategory as $subcategoryName => $rating) {
                   $total = $resultsByTeam['categoryArr'][$categoryName][$subcategoryName]['total'];
                   $percentage = ($rating * 100) / $total;
                   $newArray[$categoryName][$subcategoryName]['percentage'] = $percentage;
                   $newArray[$categoryName][$subcategoryName]['rating'] = $rating;
                   $newArray[$categoryName][$subcategoryName]['total'] = $total;
               }
           }
            $i = 0;

            foreach ($newArray as $categoryName => $subcategory) {
                $sortedArray = $this->array_sort($subcategory, 'percentage', SORT_DESC);
                $result['children'][$i] = array('name' => ucfirst(substr($categoryName, 0 ,7)).'...');
                foreach ($sortedArray as $subcategoryName => $subcategoryValues) {
                    $key = ceil($subcategoryValues['percentage']/$divident);
                    $color = $fillcolor[$key];
                    $result['children'][$i]['children'][] = array(
                        "name" => ucfirst($subcategoryName . " (" . $subcategoryValues['rating'] . ")"),
                        "size" => ($subcategoryValues['percentage'])/10,
                        'rating' => $subcategoryValues['percentage'],
                        'value' => $color
                    );
                }
                $i++;
            }

            $result['name'] = $team->getName();
        }

        print(json_encode($result));exit;

    }

    public function compareAction()
    {
        $request = $this->getRequest();

        if ($request->isPost()) {

            $data = \Zend\Json\Json::decode($request->getContent());

            $postData['year'] = isset($data->year) ? $data->year : $this->getYear();
            $postData['quarter'] = isset($data->quarter) ? $data->quarter : $this->getQuarter();
            $year = $postData['year'];
            $quarter = $postData['quarter'];
            $postData['team'] = $data->team;


        } else {
            $postData['year'] = isset($data->year) ? $data->year : $this->getYear();
            $postData['quarter'] = isset($data->quarter) ? $data->quarter : $this->getQuarter();
            $year = $postData['year'];
            $quarter = $postData['quarter'];
            $postData['team'] = array("4","3");
        }



        foreach ($postData['team'] as $teamId) {
            $queryParams = array(
                'teamId' => $teamId,
                'type' => 'graph',
                'year' => $year,
                'quarter' => $quarter
            );
            $isAllowed = 1;
            $resultsByTeam = array();
            if($isAllowed) {
                $resultsByTeam = $this->findAnswersByTeamAction($queryParams);
            }
            foreach ($resultsByTeam['teamRating'] as $categoryName => $subcategory) {
                foreach ($subcategory as $subcategoryName => $rating) {
                    $total = $resultsByTeam['categoryArr'][$categoryName][$subcategoryName]['total'];
                    $percentage = ($rating * 100) / $total;
                    $newArray[$categoryName][$subcategoryName]['percentage'] = $percentage;
                    $newArray[$categoryName][$subcategoryName]['rating'] = $rating;
                    $newArray[$categoryName][$subcategoryName]['total'] = $total;
                    if (!is_nan($percentage)) {
                        $catArr[$teamId][$categoryName]['percentage1'][] = $percentage;
                        $catArr[$teamId][$categoryName]['percentage'][0] = $catArr[$teamId][$categoryName]['percentage'][0] + $percentage ;
                    }
                    $avg[$teamId][$categoryName]['average'] = count($catArr[$teamId][$categoryName]['percentage1']) > 0 ? $catArr[$teamId][$categoryName]['percentage'][0] / count($catArr[$teamId][$categoryName]['percentage1']) : 0;
                }
            }
        }

        foreach ($avg as $teamId => $category) {
            $i = 0;
            $team = $this->getEntityManager()->getRepository('Application\Entity\Team')->findOneBy(array("id" => $teamId));
            foreach ($category as $catname => $average) {
                $catavg[$i]['categorie'] = $catname;
                if(is_nan($average['average'])) {
                    $catavg[$i]['values'][] = array("value" => 0,"rate" => $team->getName());

                } else {
                    $catavg[$i]['values'][] = array("value" => $average['average'],"rate" => $team->getName());

                }
                $i++;
            }
        }

        print json_encode($catavg);
        exit;

    }

    public function rapportAction()
    {
        $messages = array();
        $this->checkUserIdentity();
        $teamId = $this->params()->fromRoute('teamId');
        if(!$teamId) {
            $teamId = $this->user->getEmployeeTeam()->getId();
        }

        $surveySearchForm = new SurveySearchForm();
        $queryParams = array(
            'teamId' => $teamId,
            'type' => 'graph',
            'quarter' => $this->getQuarter()
        );
        $surveySearchForm->get('quarter')->setValue($this->getQuarter());
        //searching
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $surveySearchForm->setData($data);
            $queryParams['year'] = $data->year;
            $queryParams['quarter'] = $data->quarter;
        }

        $result = array();
        return new ViewModel(array(
            'surveySearchForm' => $surveySearchForm,
            'formAction' => 'survey-rapport',
            'result' => json_encode($result),
            'messages' => $messages,
            'team' => $this->getEntityManager()->getRepository('Application\Entity\Team')->findOneBy(array("id" => $teamId)),
            'swot' => $this->getTeamSwot($queryParams)
        ));
    }



    private function getTeamSwot($params)
    {
        $queryParams = array(
            'teamId' => $params['teamId'],
            'type' => 'graph',
            'year' => isset($params['year']) ? $params['year'] : $this->getYear(),
            'quarter' => isset($params['quarter']) ? $params['quarter'] : $this->getQuarter()
        );
        $isAllowed = $this->checkUserAllowed($params['teamId']);
        $resultsByTeam = array();
        if($isAllowed) {
            $resultsByTeam = $this->findAnswersByTeamAction($queryParams);
        }

        $swotArray = array();
        if($resultsByTeam) {
            foreach ($resultsByTeam['teamRating'] as $cname => $category) {
                foreach ($category as $subcategory => $rating) {
                    $rating = floor($rating) == $rating ? floor($rating) : ($rating);
                    $swotArray[$cname.'/'.$subcategory] = $rating;
                }
            }
        }
        asort($swotArray);
        return array(
            "strengths" => array_reverse(array_slice($swotArray, -5)),
            "improvements" => array_slice($swotArray, 0, 5, true)
        );
    }
}
