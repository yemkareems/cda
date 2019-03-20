<?php
namespace Application\page;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class QuestionAddFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'subcategory',
            'required' => true,
        ));

        $this->add(array(
            'name' => 'question',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 500,
                    )
                ),
            ),
        ));
    }
}