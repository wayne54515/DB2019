<?php
/**
 * 
 * 
 */
namespace App\Services;

use App\Models\Table;

class TableService
{
    /** @var Table */
    protected $table;

    public function __construct(Table $table){
        $this->table = $table;
    }

    public function getAllTable(){
        return $this->table->all();
    }

    public function insertTable($input_data){
        $this->table->create($input_data);
    }

    public function updateTable($id, $input_data){
        $table = $input_data['table'];
        $this->rank->find($id)->update($table);
    }

    public function deleteTable($id){
        $this->rank->destroy($id);
    }
}