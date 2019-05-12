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
        return $this->rank->all();
    }

    public function insertRank($input_data){
        $this->rank->create($input_data);
    }

    public function updateRank($id, $input_data){
        $rank = $input_data['rank'];
        $this->rank->find($id)->update($rank);
    }

    public function deleteRank($id){
        $this->rank->destroy($id);
    }
}