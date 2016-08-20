<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;

class IndexController extends Controller
{
    //
    public function index(){
        $pros = Project::where('status', 1)->take(3)->get();
        //dd($pros);exit;
        return view('index', ['pros'=>$pros]);
    }
}
