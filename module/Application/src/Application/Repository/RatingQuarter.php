<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

class RatingQuarter extends EntityRepository
{

    public function findAnswersByTeamAction($params)
    {
        $queryParams['radarType'] = $params['radarType'];
        $queryParams['year'] = $params['year'];
        $queryParams['quarter'] = $params['quarter'];
        $queryParams['teamId'] = $params['teamId'];

        $sql = "select rq.emp_id,s.id,r.name as radar, q.id as qid, q.question, c.name as category, c.level as level, s.name as subcategory, sum(round(rq.weightage/2,1)) as avg_rating, count(rq.weightage) as total from radar r
                left join category c on r.id = c.radar_id
                left join subcategory s on c.id = s.category_id
                left join question q on s.id = q.subcategory_id
                left join rating_quarter rq on q.id = rq.question_id
                where r.name = :radarType
                and rq.year = :year
                and rq.quarter = :quarter
                and rq.weightage >= 0
                and rq.emp_id IN (select emp_id from employee_team where team_id = :teamId) group by s.id,rq.emp_id order by c.id ASC,s.id asc";
        $query = $this->_em->getConnection()->prepare($sql);
        $query->execute($queryParams);

        return $query->fetchAll();
    }

    public function findLastSubCategory($params) {
        $queryParams['year'] = $params['year'];
        $queryParams['quarter'] = $params['quarter'];
        $queryParams['empId'] = $params['empId'];

        $sql = "select max(s.id) as sid, rq.question_id as qid from subcategory s
                left join question q on s.id = q.subcategory_id
                left join rating_quarter rq on q.id = rq.question_id
                and rq.year = :year
                and rq.quarter = :quarter
                and rq.emp_id IN (select emp_id from employee_team where emp_id = :empId) group by s.id,rq.emp_id order by qid desc LIMIT 1";
        $query = $this->_em->getConnection()->prepare($sql);
        $query->execute($queryParams);

        $result =  $query->fetchAll();

        $sid = 1;

        if($result[0]['qid'] != '') {
            $sql = "select s.id as sid from subcategory s where id >".$result[0]['sid']." LIMIT 1";
            $query = $this->_em->getConnection()->prepare($sql);
            $query->execute($queryParams);
            $result =  $query->fetchAll();

            $sid = $result[0]['sid'];
        }
        return $sid;



    }


    public function getStrengthWeaknessSummary($params)
    {
        $queryParams['radarType'] = $params['radarType'];
        $queryParams['year'] = $params['year'];
        $queryParams['quarter'] = $params['quarter'];
        $queryParams['teamId'] = $params['teamId'];

        $sql = "select rq.emp_id,s.id as sid,r.name as radar, q.id as qid, q.question, c.name as category, c.level as level, s.name as subcategory, avg(round(rq.weightage/2,1)) as rating from radar r
                left join category c on r.id = c.radar_id
                left join subcategory s on c.id = s.category_id
                left join question q on s.id = q.subcategory_id
                left join rating_quarter rq on q.id = rq.question_id
                where r.name = :radarType
                and rq.year = :year
                and rq.quarter = :quarter
                and rq.weightage >= 0

                and rq.emp_id IN (select emp_id from employee_team where team_id = :teamId) group by q.id,rq.emp_id order by rating asc";

        $query = $this->_em->getConnection()->prepare($sql);
        $query->execute($queryParams);

        return $query->fetchAll();
    }



}
