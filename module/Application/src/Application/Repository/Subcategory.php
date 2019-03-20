<?php

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

class Subcategory extends EntityRepository
{

    public function findPrevious($subCategoryId)
    {

        $sql = "select s.id as sid from subcategory s where id <".$subCategoryId." order by id desc LIMIT 1";
        $query = $this->_em->getConnection()->prepare($sql);
        $query->execute();
        $result =  $query->fetchAll();

        $sid = 0;
        if($result[0]['sid']){
            $sid = $result[0]['sid'];
        }
        return $sid;
    }

    public function findMax() {
        $sql = "select max(s.id) as sid from subcategory s LIMIT 1";
        $query = $this->_em->getConnection()->prepare($sql);
        $query->execute();
        $result =  $query->fetchAll();

        $sid = 0;
        if($result[0]['sid']){
            $sid = $result[0]['sid'];
        }
        return $sid;
    }


}
