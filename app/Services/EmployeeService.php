<?php
/**
 * 
 * 
 */
namespace App\Services;

use App\Models\Employee;

class EmployeeService
{
    /** @var Employee */
    protected $employee;

    public function __construct(Employee $employee){
        $this->employee = $employee;
    }

    public function getAllEmployee(){
        return $this->employee->all();
    }

    public function getEmployeeById($id){
        return $this->employee->find($id);
    }

    public function insertEmployee($input_data){
        $employee = $input_data['employee'];
        $this->employee->create($employee);
    }

    public function updateEmployee($id, $input_data){
        $employee = $input_data['employee'];
        $this->employee->find($id)->update($employee);
    }

    public function deleteEmployee($id){
        $this->employee->destroy($id);
    }
}