<?php
namespace Application\page;

use Zend\Form\Form;

class SurveyForm extends Form
{
    public function __construct()
    {
        parent::__construct('survey');
        parent::setAttribute('method', 'post');

        $this->add(array(
            'name' => 'finish',
            'attributes' => array(
                'type' => 'submit',
                'required' => 'required',
                'value' => 'Finish',
                'class' => 'rating-submit',
                'id' => 'btnSubmit'
            ),
        ));

        $this->add(array(
            'name' => 'next',
            'attributes' => array(
                'type' => 'submit',
                'required' => 'required',
                'value' => 'Next >>',
                'class' => 'rating-submit',
                'id' => 'btnSubmit'
            ),
        ));


        $this->add(array(
            'name' => 'save',
            'attributes' => array(
                'type' => 'submit',
                'required' => 'required',
                'value' => 'Save',
                'class' => 'rating-submit',
                'id' => 'btnSubmit'
            ),
        ));
    }
}