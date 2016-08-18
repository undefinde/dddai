<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Att;

class CheckController extends Controller
{
    public function checkList(){
        $list = Project::get();
        return view('prolist', ['list'=>$list]);
    }

    public function check($pid){
        $project = Project::find($pid);
        if(empty($project)){
            return redirect('/prolist');
        }
        $att = Att::where('pid', $pid)->get();
        return view('check', ['project'=>$project, 'att'=>$att]);
    }

    public function checked(Request $req){
        $pid = $req->pid;
        $pro = Project::find($pid);
        $att = Att::where('pid', $pid)->first();

        $pro->title = $req->title;
        $pro->hrange = $req->hrange;
        $pro->rate = $req->rate;
        $pro->status = $req->status;
        $att->realname = $req->realname;
        $att->gender = $req->gender;
        $att->age = $req->age;
        $att->udesc = $req->udesc;
        $att->salary = $req->salary;

        if($pro->save() && $att->save()){
            return redirect('/prolist');
        }else{
            return 'error';
        }
    }
}
