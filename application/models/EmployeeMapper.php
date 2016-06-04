<?php

class Application_Model_EmployeeMapper {

    protected $_dbTable;

    public function setDbTable($dbTable) {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable() {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Employee');
        }
        return $this->_dbTable;
    }

    public function fetchAll() {
        $table = $this->getDbTable();
        $resultSet = $table->fetchAll($table->select()->order('employee_id'));
        $entries = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Employee();
            $entry->setEmployeeId($row->employee_id)
                    ->setFirstName($row->first_name)
                    ->setLastName($row->last_name)
                    ->setEmail($row->email)
                    ->setPhoneNumber($row->phone_number)
                    ->setHireDate($row->hire_date)
                    ->setJobId($row->job_id)
                    ->setSalary($row->salary)
                    ->setCommissionPct($row->commission_pct);
            $entries[] = $entry;
        }
        return $entries;
    }

    public function save(Application_Model_Employee $employee) {
        $data = array(
            'email' => $employee->getEmail(),
            'first_name' => $employee->getFirstName(),
            'last_name' => $employee->getLastName(),
            'phone_number' => $employee->getPhoneNumber(),
            'hire_date' => $employee->getHireDate(),
            'job_id' => $employee->getJobId(),
            'salary' => $employee->getSalary(),
            'commission_pct' => $employee->getCommissionPct(),
        );

        if (null === ($id = $employee->getEmployeeId())) {
            unset($data['EMPLOYEE_ID']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('EMPLOYEE_ID = ?' => $id));
        }
    }

    public function find($employee_id, Application_Model_Employee $employee) {
        $result = $this->getDbTable()->find($employee_id);
        
        $result = $this->getDbTable()->delete($employee_id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $employee->setEmployeeId($row->employee_id)
                ->setFirstName($row->first_name)
                ->setLastName($row->last_name)
                ->setEmail($row->email)
                ->setPhoneNumber($row->phone_number)
                ->setHireDate($row->hire_date)
                ->setJobId($row->job_id)
                ->setSalary($row->salary)
                ->setCommissionPct($row->commission_pct);
    }
    
    
    
    

}

?>
