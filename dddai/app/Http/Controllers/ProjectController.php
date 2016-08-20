<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Att;
use DB;

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
        $pro->money = $req->money * 100;
        $pro->pubtime = time();
        $pro->save();

        $att->uid = $req->user()->uid;
        $att->age = $req->age;
        $att->pid = $pro->pid;
        $att->save();
    }

    public function getZd(){
        $refund = DB::table('refunds')->get();
        return view('myzd', ['refund'=>$refund]);
    }

    public function getTz(Request $req){
        $bid = DB::table('bids')->where('uid', $req->user()->uid)->get();

        return view('mytz', ['bid'=>$bid]);
    }

    public function getSy(Request $req){
        $grow = DB::table('grows')->where('uid', $req->user()->uid)->get();
         return view('mysy', ['grow'=>$grow]);
    }

    public function getDk(){

        return view('mydk');
    }
}
