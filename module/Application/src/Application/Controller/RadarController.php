<?php
/**
 * Created by PhpStorm.
 * User: kareem
 * Date: 22/2/16
 * Time: 2:22 PM
 */

namespace Application\Controller;


class RadarController extends BaseController {

    public function getAllRadarsAction()
    {
        $radar = $this->getEntityManager()->getRepository('Application\Entity\Radar')->findAll();
        foreach ($radar as $obj) {
            $view[$obj->getId()] = ucfirst($obj->getName()) . ' Radar';
        }
        $variables = json_encode($view);
        print $variables;
        exit;
    }


    public function getCategoriesAction()
    {
        $radar = $this->params()->fromPost('radar');
        $radar = $this->getEntityManager()->find('Application\Entity\Radar', $radar);
        $category = $this->getEntityManager()->getRepository('Application\Entity\Category')->findBy(array("radar" => $radar));
        foreach ($category as $obj) {
            $view[$obj->getId()] = ucfirst($obj->getName());
        }
        $variables = json_encode($view);
        print $variables;
        exit;
    }

    public function getCategorySubcategoriesAction()
    {
        $category = $this->params()->fromPost('category');
        $category = $this->getEntityManager()->find('Application\Entity\Category', $category);
        $subcategory = $this->getEntityManager()->getRepository('Application\Entity\Subcategory')->findBy(array("category" => $category));
        foreach ($subcategory as $obj) {
            $view[$obj->getId()] = ucfirst($obj->getName());
        }
        $variables = json_encode($view);
        print $variables;
        exit;
    }

}