<?php
namespace Application\page;

use Zend\Form\Form;

class TeamMemberAddForm extends Form
{
    public function __construct()
    {
        parent::__construct('question');
        parent::setAttribute('method', 'post');

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'team',
            'required' => true,
            'attributes' => array(
                'options' => array(),
                'id' => 'selectTeam',
            ),
            'options' => array(
                'disable_inarray_validator' => true,
            )
        ));

        $this->add(array(
            'name' => 'code',
            'required' => true,
            'attributes' => array(
                'type' => 'Text',
                'required' => 'required',
                //'placeholder' => 'Employee code',
                'autofocus' => 'autofocus',
                'id' => 'textCode',
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