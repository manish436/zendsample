<?php

class Application_Form_Employee extends Zend_Form {

    public function init() {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Add an employee_id hiden element for edit
        $this->addElement('hidden', 'employeeid', array());

        // Add the first name element
        $this->addElement('text', 'FirstName', array(
            'label' => 'First Name:',
            'required' => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 20))
            )
        ));

        // Add the last name element
        $this->addElement('text', 'LastName', array(
            'label' => 'Last Name:',
            'required' => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 20))
            )
        ));

        // Add an email element
        $this->addElement('text', 'email', array(
            'label' => 'Email address:',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array('EmailAddress')
        ));

        $this->addElement('text', 'HireDate', array(
            'label' => 'Hire Date:',
            'required' => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(9, 9))
            )
        ));

        // Add the job id element
        $this->addElement('select', 'JobId', array(
            'label' => 'Job Title:',
            'required' => true,
            'multioptions' => array('AD_VP' => 'Vice President', 'AD_PRES' => 'President')
        ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Create Employee',
        ));

        // Add the cancel button
        $this->addElement('button', 'cancel', array(
            'ignore' => true,
            'label' => 'Cancel Action',
        ));
    }

}

?>
