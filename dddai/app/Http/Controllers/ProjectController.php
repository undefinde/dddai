<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Att;

class ProjectController extends Controller
{
    //
    public function getBorrow(){
        //var_dump(Auth::user());
        return view('borrow');
    }

    public function postBorrow(Request $req){
        $pro = new Project();
        $att = new Att();

        $pro->uid = $req->user()->uid;
        $pro->name = $req->user()->name;
        $pro->mobile = $req->mobile;
        $pro->money = $req->money;
        $pro->pubtime = time();
        $pro->save();

        $att->uid = $req->user()->uid;
        $att->age = $req->age;
        $att->pid = $pro->pid;
        $att->save();
    }
}
