<?php
/**
 * 
 * 
 */
namespace App\Services;

use App\Models\Trade;

class TradeService
{
    /** @var Trade */
    protected $trade;

    public function __construct(Trade $trade){
        $this->trade = $trade;
    }

    public function getAllTrade(){
        return $this->trade->all();
    }

    public function insertTrade($input_data){
        $this->trade->create($input_data);
    }

    public function updateTrade($id, $input_data){
        $trade = $input_data['trade'];
        $this->trade->find($id)->update($trade);
    }

    public function deleteTrade($id){
        $this->trade->destroy($id);
    }
}