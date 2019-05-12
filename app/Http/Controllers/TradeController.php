<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\TradeService;

class TradeController extends Controller
{
    /** @var TradeService */
    protected $tradeService;

    /**
     * 建構子
     */
    public function __construct(TradeService $tradeService){
        $this->tradeService = $tradeService;
    }

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['trade' => $this->tradeService->getAllTrade()],
                200, $this->header, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input_data = $request->all();
        $this->tradeService->insertTrade($input_data);

        return response()->json(['status'=> 'ok'], 200, $this->header);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $request->all();
        $teade_id = $this->userService->getIdByName($data['user_id']);

        return response()->json(['trade_id' => $trade_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(['trade' => $this->tradeService->getTradeById($id)],
            200, $this->header, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input_data = $request->all();
        $this->tradeService->updateTrade($id, $input_data);

        return response()->json(['status' => 'ok'], 200, $this->header);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->tradeService->deleteTrade($id);

        return response()->json(['status' => 'ok'], 200, $this->header);
    }
}