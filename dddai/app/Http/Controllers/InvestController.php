<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Bid;
use DB;
class InvestController extends Controller
{
    //
    public function getInvest($pid){
        $pro = Project::find($pid);
        return view('invest', ['pro'=>$pro]);
    }

    public function postInvest(Request $req,  $pid){
        $bid = new Bid();
        $pro = Project::find($pid);
        $money =  ($req->money)*100;
        $leave = $pro->money - ($pro->receive + $money);
        if($pro->status > 1){
            return '已不再招标';
        }elseif($leave < 0){
            return '投入的钱过多';
        }else{
            $bid->uid = $req->user()->uid;
            $bid->pid = $req->pid;
            $bid->title = $req->title;
            $bid->money = $money;
            $bid->pubtime = time();

            $bid->save();
            //用laravel自增的方式加钱
            $pro->increment('receive', $money);
            //判断如果receive和mone相等则开始收益
            if($pro->money == $pro->receive){
                $this->investDone($pro);
            }
        }
    }

    protected function investDone($pro){
        //如果receive 修改状态为收益中
        $pro->status = 2;
        $pro->save();
        //为借款者生成还款记录
        $row = ['uid'=>$pro->uid, 'pid'=>$pro->pid, 'title'=>$pro->title];
        $row['amount'] = ($pro->money * $pro->rate / 1200) + ($pro->mondy/$pro->hrange); //每月应还多少钱
        $today = date('Y-m-d', time());
        for($i=1; $i<=$pro->hrange; $i++){
            $paydate = date('Y-m-d', strtotime("+ $i months"));
            $row['paydate'] = $paydate;
            $row['status'] = 0;
            DB::table('refunds')->insert($row);
        }
        //为投资者生成收益记录
        $bids = DB::table('bids')->where('pid', $pro->pid)->get();
        $row = [];
        $row = ['pid'=>$pro->pid, 'title'=>$pro->title];
        $row['enddate'] = date('Y-m-d' , strtotime("+ {$pro->hrange} months"));
        foreach($bids as $bid){
            $row['uid'] = $bid->uid;
            $row['amount'] = $bid->money * $pro->rate / 36500;
            DB::table('tasks')->insert($row);
        }
    }


}
