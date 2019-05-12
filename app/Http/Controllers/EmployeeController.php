<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    /** @var EmployeeService */
    protected $employeeService;

    /**
     * 建構子
     */
    public function __construct(EmployeeService $employeeService){
        $this->employeeService = $employeeService;
    }

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['employee' => $this->employeeService->getAllEmployee()],
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
        $this->employeeService->insertEmployee($input_data);

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
        $employee_id = $this->employeeService->getIdByName($data['employee_name']);

        return response()->json(['employee_id' => $employee_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(['employee' => $this->employeeService->getEmployeeById($id)],
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
        $this->employeeService->updateEmployee($id, $input_data);

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
        $this->employeeService->deleteEmployee($id);

        return response()->json(['status' => 'ok'], 200, $this->header);
    }
}