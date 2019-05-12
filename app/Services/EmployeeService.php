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

    public function insertEmployee($input_data){
        $this->employee->create($input_data);
    }

    public function updateEmployee($id, $input_data){
        $employee = $input_data['employee'];
        $this->employee->find($id)->update($food);
    }

    public function deleteEmployee($id){
        $this->employee->destroy($id);
    }
}