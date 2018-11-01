<?php

namespace App\Http\Controllers;

use App\Model\EventPrize;
use App\Model\Events;
use Illuminate\Http\Request;

class EventPrizeController extends Controller
{
    public function index()
    {
        $totime = date('Y-m-d',time());
        $data = EventPrize::paginate(1);
        return view('eventprize.list',compact('data','totime'));
    }

    public function create()
    {
        //活动开奖之前可以为该活动添加添加奖品，开奖后不可以添加
        $totime = date('Y-m-d',time());
        $data = Events::where(function ($query) use ($totime){
                $query->where('prize_date','>',$totime);
        })->get();
        return view('eventprize.create',compact('data'));
    }

    public function store(Request $request)
    {

        $this->validate($request,[
           'name'=>'required',
           'description'=>'required',
           'events_id'=>'required',
        ]);
        $data = [
            'name'=>$request->name,
            'description'=>$request->input('description'),
            'events_id'=>$request->events_id,
        ];
        EventPrize::create($data);
        return redirect()->route('eventprizes.index')->with('success','添加活动奖品成功');
    }

    public function edit(Request $request,EventPrize $eventprize)
    {
        $data = Events::all();
        return view('eventprize.edit',compact('data','eventprize'));
    }

    public function update(Request $request,EventPrize $eventprize)
    {
        $this->validate($request,[
           'name'=>'required',
           'description'=>'required',
           'events_id'=>'required',
        ]);
        $eventprize->update($request->input());
        return redirect()->route('eventprizes.index')->with('success','修改活动奖品成功');
    }

    public function destroy(Request $request,EventPrize $eventprize)
    {
        $eventprize->delete();
        return 'success';
    }
}
