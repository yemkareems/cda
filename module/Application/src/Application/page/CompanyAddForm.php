<?php
namespace Application\page;

use Zend\Form\Form;

class CompanyAddForm extends Form
{
    public function __construct()
    {
        parent::__construct('question');
        parent::setAttribute('method', 'post');

        $this->add(array(
            'name' => 'company',
            'required' => true,
            'attributes' => array(
                'type' => 'Text',
                'required' => 'required',
                //'placeholder' => 'Company Name',
                'autofocus' => 'autofocus',
                'id' => 'textCompany',
                'size' => 30,
            ),
        ));

        $this->add(array(
            'name' => 'firstname',
            'required' => true,
            'attributes' => array(
                'type' => 'Text',
                'required' => 'required',
                //'placeholder' => 'Firstname',
                'id' => 'textFirstname',
            ),
        ));

        $this->add(array(
            'name' => 'lastname',
            'required' => true,
            'attributes' => array(
                'type' => 'Text',
                'required' => 'required',
                //'placeholder' => 'Lastname',
                'id' => 'textLastname',
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'required' => true,
            'attributes' => array(
                'type' => 'Text',
                'required' => 'required',
                //'placeholder' => 'Email Address',
                'id' => 'textEmail',
                'size' => 40,
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