<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class GrowController extends Controller
{
    //获取收益
    public function getGrow(){
        $today = date('Y-m-d', time());
        $tasks = DB::table('tasks')->where('enddate', '>=', $today)->get();
        foreach($tasks as $t){
            $t->paytime = $today;
            $t = (array)$t;
            unset($t['tid']);
            unset($t['enddate']);
            DB::table('grows')->insert($t);
        }
    }
}
