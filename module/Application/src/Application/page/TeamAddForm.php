<?php
namespace Application\page;

use Zend\Form\Form;

class TeamAddForm extends Form
{
    public function __construct()
    {
        parent::__construct('question');
        parent::setAttribute('method', 'post');

        $this->add(array(
            'name' => 'name',
            'required' => true,
            'attributes' => array(
                'type' => 'Text',
                'required' => 'required',
                //'placeholder' => 'Name',
                'autofocus' => 'autofocus',
                'id' => 'textName',
                'size' => 30,
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