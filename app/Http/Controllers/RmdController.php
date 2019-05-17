<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process; 
use Symfony\Component\Process\Exception\ProcessFailedException; 

use App\Http\Requests;
use App\Services\RankService;

class RmdController extends Controller
{
    /** @var RankService */
    protected $rankService;

    /**
     * 建構子
     */
    public function __construct(RankService $rankService){
        $this->rankService = $rankService;
    }

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $process = new Process('python py/get_sql_data.py'); 
        $process->run(); 

        // executes after the command finishes 
        if (!$process->isSuccessful()) { 
            throw new ProcessFailedException($process); 
        } 

        $result =  $process->getOutput();
        $process->stop();

        return response()->json(['status' => 'OK'], 200, $this->header, JSON_UNESCAPED_UNICODE);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $user_rank_num = $this->rankService->getUserRankNum($user_id);
        if($user_rank_num == 0)
            return response()->json(['rmd' => []], 200, $this->header, JSON_UNESCAPED_UNICODE);
        else{
            $process = new Process("python py/getRankModel.py $user_id"); 
            $process->run(); 

            // executes after the command finishes 
            // if (!$process->isSuccessful()) { 
            //     throw new ProcessFailedException($process); 
            // } 

            $result =  $process->getOutput();
            $process->stop();

            $json = file_get_contents('recommend.json');

            $rmd_data = json_decode($json, true);

            return response()->json(['rmd' => $rmd_data], 200, $this->header, JSON_UNESCAPED_UNICODE);
        }  
    }
}