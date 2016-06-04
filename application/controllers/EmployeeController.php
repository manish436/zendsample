<?php

class EmployeeController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $employee = new Application_Model_EmployeeMapper();
        $this->view->entries = $employee->fetchAll();
    }

    public function newAction() {
        $request = $this->getRequest();
        $form = new Application_Form_Employee();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $employee = new Application_Model_Employee(
                        $form->getValues());
                $mapper = new Application_Model_EmployeeMapper();
                $mapper->save($employee);
                return $this->_helper->redirector('index');
            }
        }

        // Associate a link with the cancel button
        $form->getElement('cancel')->setAttrib('onclick', "window.open('" .
                $this->view->url(array(
                    'controller' => 'employee',
                    'action' => 'index'
                        ), 'default', true) .
                "','_self')");

        $this->view->form = $form;
    }

    public function editAction() {
        $request = $this->getRequest();
        $form = new Application_Form_Employee();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $employee = new Application_Model_Employee($form->getValues());
                $employee->setEmployeeId($this->getRequest()->employeeid);

                $mapper = new Application_Model_EmployeeMapper();
                $mapper->save($employee);
                return $this->_helper->redirector('index');
            }
            // invalid fields - need old employee to set the name back
            $employee_id = $this->getRequest()->id;
            $mapper = new Application_Model_EmployeeMapper();
            $employee = new Application_Model_Employee();
        } else {
            // initial rendering of the form, get the employee ID
            // from the parameters
            $employee_id = $this->getRequest()->id;
            $mapper = new Application_Model_EmployeeMapper();
            $employee = new Application_Model_Employee();
            $mapper->find($employee_id, $employee);



            if ($employee->getEmployeeId() == $employee_id) {
                $data = array(
                    'employeeid' => $employee_id,
                    'FirstName' => $employee->getFirstName(),
                    'LastName' => $employee->getLastName(),
                    'email' => $employee->getEmail(),
                    'PhoneNumber' => $employee->getPhoneNumber(),
                    'HireDate' => $employee->getHireDate(),
                    'JobId' => $employee->getJobId(),
                    'Salary' => $employee->getSalary(),
                    'CommissionPct' => $employee->getCommissionPct()
                );
                $form->populate($data);
            } else {
                // redirect to new action if the employee ID is invalid
                return $this->_helper->redirector('new');
            }
        }


        // Add the link to the cancel button
        $form->getElement('cancel')->setAttrib('onclick', "window.open('" .
                $this->view->url(array(
                    'controller' => 'employee',
                    'action' => 'index'
                        ), 'default', true) .
                "','_self')");

        $this->view->employee = $employee;
        $this->view->form = $form;
    }

    function deleteAction() {
        // action body
    }


}
