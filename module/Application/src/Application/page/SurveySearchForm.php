<?php
namespace Application\page;

use Zend\Form\Form;

class SurveySearchForm extends Form
{
    public function __construct()
    {
        parent::__construct('surveySearch');
        parent::setAttribute('method', 'post');

        $years = range(date('Y'), 2006);
        $quarters = range(1, 4);

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'year',
            'required' => true,
            'attributes' => array(
                'options' => array_combine($years, $years),
                'id' => 'selectYear'
            ),
            'options' => array(
                'disable_inarray_validator' => true,
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'quarter',
            'required' => true,
            'attributes' => array(
                'options' => array_combine($quarters, $quarters),
                'id' => 'selectQuarter',
            ),
            'options' => array(
                'disable_inarray_validator' => true,
            )
        ));

        $this->add(array(
            'name' => 'submitRadar',
            'attributes' => array(
                'type' => 'submit',
                'required' => 'required',
                'value' => 'Radar',
                'class' => 'linkButton',
                'id' => 'btnRadar'
            ),
        ));

        $this->add(array(
            'name' => 'submitGraph',
            'attributes' => array(
                'type' => 'submit',
                'required' => 'required',
                'value' => 'Graph',
                'class' => 'linkButton',
                'id' => 'btnGraph'
            ),
        ));

        $this->add(array(
            'name' => 'submitTree',
            'attributes' => array(
                'type' => 'submit',
                'required' => 'required',
                'value' => 'Tree',
                'class' => 'linkButton',
                'id' => 'btnTree'
            ),
        ));

        $this->add(array(
            'name' => 'submitBarGraph',
            'attributes' => array(
                'type' => 'submit',
                'required' => 'required',
                'value' => 'Bar Graph',
                'class' => 'linkButton',
                'id' => 'btnBarGraph'
            ),
        ));

        $this->add(array(
            'name' => 'submitSummary',
            'attributes' => array(
                'type' => 'submit',
                'required' => 'required',
                'value' => 'Summary',
                'class' => 'linkButton',
                'id' => 'btnSummary'
            ),
        ));

        $this->add(array(
            'name' => 'submitReport',
            'attributes' => array(
                'type' => 'submit',
                'required' => 'required',
                'value' => 'PDF',
                'class' => 'linkButton',
                'id' => 'btnReport'
            ),
        ));

        $this->add(array(
            'name' => 'submitAnalyze',
            'attributes' => array(
                'type' => 'submit',
                'required' => 'required',
                'value' => 'Overview',
                'class' => 'linkButton',
                'id' => 'btnAnalyze'
            ),
        ));
    }
}