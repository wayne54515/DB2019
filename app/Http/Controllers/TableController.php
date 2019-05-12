<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\TableService;

class TableController extends Controller
{
    /** @var TableService */
    protected $tableService;

    /**
     * 建構子
     */
    public function __construct(TableService $tableService){
        $this->tableService = $tableService;
    }

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['table' => $this->tableService->getAllTable()],
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
        $this->tableService->insertTable($input_data);

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
        $table_id = $this->tableService->getIdByName($data['user_id']);

        return response()->json(['table_id' => $table_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(['table' => $this->tableService->getTableById($id)],
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
        $this->tableService->updateTable($id, $input_data);

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
        $this->tableService->deleteTable($id);

        return response()->json(['status' => 'ok'], 200, $this->header);
    }
}