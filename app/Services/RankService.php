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

    public function getRankByUserId($user_id){
        $temp = $this->rank->select('food_id', 'rank')->where("user_id", "=", $user_id)->get();
        $rank = [];
        foreach($temp as $value){
            $rank[$value['food_id']] = $value['rank'];
        }
        return $rank;
    }

    public function insertRank($input_data){
        $rank = $input_data['rank'];
        $this->rank->create($rank);
    }

    public function updateRank($input_data){
        $rank = $input_data['rank'];
        $food_id = $rank['food_id'];
        $user_id = $rank['user_id'];
        $this->rank->where("food_id", "=", $food_id)
                ->where("user_id", "=", $user_id)
                ->update($rank);
    }

    public function deleteRank($input_data){
        $food_id = $input_data['food_id'];
        $user_id = intval($input_data['user_id']);
        $this->rank->where("food_id", "=", $food_id)
                ->where("user_id", "=", $user_id)
                ->delete();
    }

    public function getUserRankNum($user_id){
        return $this->rank->where("user_id", "=", $user_id)->count();
    }
}