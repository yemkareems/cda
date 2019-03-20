<?php
namespace Application\page;

use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct('auth');
        parent::setAttribute('method', 'post');

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type' => 'text',
                'required' => 'required',
                'placeholder' => 'Email Address',
                'autofocus' => 'autofocus',
                'size' => 30
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type' => 'password',
                'required' => 'required',
                'placeholder' => 'Password',
                'size' => 30
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'required' => 'required',
                'value' => 'LOGIN',
                'class' => 'submit-button'
            ),
        ));
    }
} 