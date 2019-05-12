<?php
/**
 * 
 * 
 */
namespace App\Services;

use App\Models\Food;

class FoodService
{
    /** @var Food */
    protected $food;

    public function __construct(Food $food){
        $this->food = $food;
    }

    public function getAllFood($filter_data){
        if(!empty($filter_data['type'])){
            return $this->food->where('type', '=', $filter_data['type'])->get();
        }
        else{
            return $this->food->all();
        }
        
    }

    public function insertFood($input_data){
        $this->food->create($input_data);
    }

    public function updateFood($id, $input_data){
        $food = $input_data['food'];
        $this->food->find($id)->update($food);
    }

    public function deleteFood($id){
        $this->food->destroy($id);
    }
}