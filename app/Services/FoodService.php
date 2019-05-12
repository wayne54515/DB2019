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

    public function getAllFood(){
        return $this->food->all();
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