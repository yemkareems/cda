<?php
namespace Application\page;

use Zend\Form\Form;

class QuestionAddForm extends Form
{
    public function __construct()
    {
        parent::__construct('question');
        parent::setAttribute('method', 'post');

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'radar',
            'required' => true,
            'attributes' => array(
                'options' => array(),
                'id' => 'selectRadar'
            ),
            'options' => array(
                'disable_inarray_validator' => true,
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'category',
            'required' => true,
            'attributes' => array(
                'options' => array(),
                'id' => 'selectCategory'
            ),
            'options' => array(
                'disable_inarray_validator' => true,
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'subcategory',
            'required' => true,
            'attributes' => array(
                'options' => array(),
                'id' => 'selectSubcategory',
            ),
            'options' => array(
                'disable_inarray_validator' => true,
            )
        ));

        $this->add(array(
            'name' => 'question',
            'required' => true,
            'attributes' => array(
                'type' => 'Text',
                'required' => 'required',
                //'placeholder' => 'Question',
                'autofocus' => 'autofocus',
                'id' => 'textQuestion',
                'size' => 65
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'required' => 'required',
                //'value' => 'Add',
                'class' => 'btn add',
                'id' => 'btnAdd'
            ),
        ));
    }
}