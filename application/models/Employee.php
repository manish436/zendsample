<?php

class Application_Model_Employee {

    protected $_employee_id;
    protected $_first_name;
    protected $_last_name;
    protected $_email;
    protected $_phone_number;
    protected $_hire_date;
    protected $_job_id;
    protected $_salary;
    protected $_commission_pct;

    public function __construct(array $options = null) {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value) {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid employee property');
        }
        $this->$method($value);
    }

    public function __get($name) {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid employee property');
        }
        return $this->$method();
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setEmployeeId($employee_id) {
        $this->_employee_id = (int) $employee_id;
        return $this;
    }

    public function getEmployeeId() {
        return $this->_employee_id;
    }

    public function setFirstName($first_name) {
        $this->_first_name = (string) $first_name;
        return $this;
    }

    public function getFirstName() {
        return $this->_first_name;
    }

    public function setLastName($last_name) {
        $this->_last_name = (string) $last_name;
        return $this;
    }

    public function getLastName() {
        return $this->_last_name;
    }

    public function setEmail($email) {
        $this->_email = (string) $email;
        return $this;
    }

    public function getEmail() {
        return $this->_email;
    }

    public function setPhoneNumber($phone_number) {
        $this->_phone_number = (string) $phone_number;
        return $this;
    }

    public function getPhoneNumber() {
        return $this->_phone_number;
    }

    public function setHireDate($hire_date) {
        $this->_hire_date = (string) $hire_date;
        return $this;
    }

    public function getHireDate() {
        return $this->_hire_date;
    }

    public function setJobId($job_id) {
        $this->_job_id = (string) $job_id;
        return $this;
    }

    public function getJobId() {
        return $this->_job_id;
    }

    public function setSalary($salary) {
        $this->_salary = (string) $salary;
        return $this;
    }

    public function getSalary() {
        return $this->_salary;
    }

    public function setCommissionPct($commission_pct) {
        $this->_commission_pct = (string) $commission_pct;
        return $this;
    }

    public function getCommissionPct() {
        return $this->_commission_pct;
    }

}
