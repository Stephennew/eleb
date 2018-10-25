<?php

namespace App\Http\Controllers;

use App\Model\EventPrize;
use App\Model\Events;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        $data = Events::paginate(1);
        return view('event.index',compact('data'));
    }

    public function create()
    {
        $prizes = EventPrize::all();
        return view('event.create',compact('prizes'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'signup_start'=>'required',
            'signup_end'=>'required',
            'prize_date'=>'required',
            'signup_num'=>'required'
        ]);
        Events::create([
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>$request->is_prize
    ]);
        return redirect()->route('events.index')->with('success','活动添加成功');
    }

    public function edit(Events $event)
    {
        return view('event.edit',compact('event'));

    }

    public function update(Request $request,Events $event)
    {
        //var_dump($_POST);exit;
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'signup_num'=>'required'
        ]);
        $data = [
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'signup_num'=>$request->signup_num,
            'is_prize'=>$request->is_prize
        ];
        if($request->signup_start != ''){
        $data['signup_start'] = strtotime($request->signup_start);
        }
        if($request->signup_end != ''){
            $data['signup_end'] = strtotime($request->signup_end);
        }
        if($request->prize_date != ''){
            $data['prize_date'] = date('Y-m-d',strtotime($request->prize_date));
        }
        Events::where('id',$event->id)->update($data);

        return redirect()->route('events.index')->with('success','修改抽奖活动成功');
    }

    public function destroy(Events $event)
    {
        $event->delete();
        return 'success';
    }

    public function lottery(Events $event)
    {
        //判断活动是否开始
        /*$totime = date('Y-m-d',time());
        if($event->prize_date !== $totime){
            return redirect()->route('events.index')->with('danger','还未到开奖时间');
        }*/
        //判断是否已经抽过奖
        if($event->is_prize == 1){
            return redirect()->route('events.index')->with('danger','该活动已经开奖');
        }
        //获取报名人员
        $member_ids = DB::table('event_members')->where('events_id',$event->id)->pluck('member_id');

        //获取该条活动的所有奖品
        $event_prize_ids = DB::table('event_prizes')->where('events_id',$event->id)->pluck('id');

        //打乱人员 奖品的顺序 随机匹配
        $renyuans = $member_ids->shuffle();
        $jiangpins = $event_prize_ids->shuffle();

        $res = [];
        foreach ($renyuans as $ren)
        {
            $jiangpin = $jiangpins->pop();
            //如果没有奖品时就跳出循环
            if($jiangpins == null) break;
            $res[$jiangpin] = $ren;
        }

        foreach ($res as $jiangid=>$renid)
        {
            DB::table('event_prizes')->where('id',$jiangid)->update(['member_id'=>$renid]);
        }
        //开奖后将该活动的状态 改为已经抽奖 1
        $event->update(['is_prize'=>1]);
        SmailController::sendMail('恭喜您中奖了，赶快查看您的奖品吧','myvtcyahoo@163.com');
        return redirect()->route('events.index')->with('success','开奖完成');
    }
}
