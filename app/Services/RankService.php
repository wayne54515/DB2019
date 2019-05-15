<?php
/**
 * 
 * 
 */
namespace App\Services;

use App\Models\Rank;

class RankService
{
    /** @var Rank */
    protected $rank;

    public function __construct(Rank $rank){
        $this->rank = $rank;
    }

    public function getAllRank(){ 
        $rank = $this->rank->select('food_id', 'rank')->get();

        $temp = [];
        foreach($rank as $value){
            //check if color exists in the temp array
            if(!array_key_exists($value['food_id'], $temp)) {
            //if it does not exist, create it with a value of 0
                $temp[$value['food_id']] = 0;
            }
            //Add up the values from each color
            $temp[$value['food_id']] += $value['rank'];
        }
        
        for($i=1 ; $i<=count($temp) ; $i++){
            $rank_num = $this->rank->where("food_id", "=", $i)->count();
            $avg_rank[$i] = round(($temp[$i]/$rank_num), 2);
        }
        
        return $avg_rank;
    }

    public function insertRank($input_data){
        $rank = $input_data['rank'];
        $this->rank->create($rank);
    }

    public function updateRank($id, $input_data){
        $rank = $input_data['rank'];
        $this->rank->find($id)->update($rank);
    }

    public function deleteRank($id){
        $this->rank->destroy($id);
    }
}