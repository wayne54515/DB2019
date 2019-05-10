<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RankController extends Controller
{
    public function index(){
        return view('rank');
    }
}