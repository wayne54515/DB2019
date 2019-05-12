<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\RankService;

class RankController extends Controller
{
    public function index(){
        return view('rank');
    }
}