<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\FoodService;

class FoodController extends Controller
{
    /** @var FoodService */
    protected $foodService;

    /**
     * 建構子
     */
    public function __construct(FoodService $foodService){
        $this->foodService = $foodService;
    }

    public function food_menu(){
        return view('food');
    }

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_data = $request->all();
        $food = $this->foodService->getAllFood($filter_data);
        return response()->json(['food' => $food], 200, $this->header, JSON_UNESCAPED_UNICODE);
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
        $this->foodService->insertFood($input_data);

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
        $food_id = $this->foodService->getIdByName($data['food_name']);

        return response()->json(['food_id' => $food_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(['food' => $this->foodService->getFoodById($id)],
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
        $this->foodService->updateFood($id, $input_data);

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
        $this->foodService->deleteFood($id);

        return response()->json(['status' => 'ok'], 200, $this->header);
    }
    
}