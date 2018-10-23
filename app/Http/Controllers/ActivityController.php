<?php

namespace App\Http\Controllers;

use App\Model\Activity;
use function foo\func;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $keywords = $request->keywords?$request->keywords:'';
        $activities_status = $request->activities_status?$request->activities_status:'';
        $totime = date('Y-m-d H:i:s',time());
        if($keywords || $activities_status){
            if($activities_status && $keywords){
                if($activities_status == 1)
                {
                    //DB::connection()->enableQueryLog();
                   /* $activities = DB::table('activities')->whereColumn([
                        ['start_time','>',$totime],
                        ['title','like','%'.$keywords.'%'],
                    ])->paginate(2);*/
                    /*$activities = Activity::where('start_time','>',$totime)
                        ->where('title','like','%'.$keywords.'%')
                        ->paginate(2);*/

                    $activities = Activity::where(function ($query) use ($totime,$keywords){
                        $query->where('start_time','>',$totime)
                            ->where('title','like','%'.$keywords.'%');
                    })->paginate(2);

                    /*$activities = DB::table('activities')  比较的是两个字段的值是否相等，所以这个地方报错，找不到该字段，因为该字段不存在
                        ->whereColumn([
                            ['start_time', '>' ,$totime],
                            ['title','like','%'.$keywords.'%'],
                        ])->paginate(2);*/
                    //var_dump(DB::getQueryLog());exit;
                }elseif ($activities_status == 2)
                {
                   /* $activities = Activity::whereColumn([
                        ['start_time','<=',$totime],
                        ['end_time','>=',$totime],
                        ['title','like','%'.$keywords.'%'],
                    ])->paginate(2);*/
                   $activities = Activity::where(function ($query) use ($totime,$keywords){
                       $query->where('start_time','<=',$totime)
                           ->where('end_time','>=',$totime)
                           ->where('title','like','%'.$keywords.'%');
                   })->paginate(2);
                }elseif ($activities_status == 3)
                {
                   /* $activities = Activity::whereColumn([
                        ['end_time','<',$totime'],
                        ['title','like','%'.$keywords.'%'],
                    ])->paginate(2);*/
                   $activities = Activity::where(function ($query) use ($totime,$keywords){
                       $query->where('end_time','<',$totime)
                           ->where('title','like','%'.$keywords.'%');
                   })->paginate(2);
                }
            }elseif($activities_status)
            {
                if($activities_status == 1)
                {
                    $activities = Activity::where('start_time','>',$totime)
                        ->paginate(2);
                }elseif ($activities_status == 2)
                {
                   /* $activities = DB::table('activities')->whereColumn([
                        ['start_time','<=',$totime],
                        ['end_time','>=',$totime],
                    ])->paginate(2);*/
                    $activities = Activity::where(function ($query) use ($totime){
                        $query->where('start_time','<=',$totime)
                            ->where('end_time','>=',$totime);
                    })->paginate(2);
                }elseif ($activities_status == 3)
                {
                    $activities = Activity::where('end_time','<',$totime)
                        ->paginate(2);
                }
            }elseif ($keywords)
            {
                $activities = Activity::where('title','like','%'.$keywords.'%')
                    ->paginate(2);
            }
        }else{
            $activities = Activity::paginate(2);
        }
        return view('activity.list',compact('activities','activities_status','keywords'));
    }

    public function create()
    {
        return view('activity.create');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'start_time'=>'required',
            'end_time'=>'required'
        ]);
        $data = [
            'title'=>$request->title,
            //将特殊字符转换为 HTML 实体
            //'content'=>htmlspecialchars($request->input('content'),ENT_QUOTES),
            'start_time'=>date('Y-m-d 00:00:00',strtotime($request->start_time)),
            'end_time'=>date('Y-m-d 23:59:59',strtotime($request->end_time)),
            'content'=>$request->input('content'),
            //'start_time'=>strtotime($request->start_time),
            //'end_time'=>strtotime($request->end_time),
        ];
        Activity::create($data);
        return redirect()->route('activities.index')->with('success','添加活动成功');

    }

    public function edit(Request $request,Activity $activity)
    {
        return view('activity.edit',compact('activity'));
    }

    public function update(Request $request,Activity $activity)
    {
        $this->validate($request,[
           'title'=>'required',
           'content'=>'required',
        ]);
        $data = [
          'title'=>$request->title,
          'content'=>$request->input('content')
        ];
        if($request->start_time != null)
        {
            if(!(strtotime($request->start_time) > time()))
            {
                return back()->with('warning','活动开始日期不能小于当前日期')->withInput();
            }
            $data['start_time'] = date('Y-m-d 00:00:00',strtotime($request->start_time));
        }
        if($request->end_time != null)
        {
            if(!(strtotime($request->end_time) > time()))
            {
                return back()->with('warning','活动结束日期不能小于当前日期')->withInput();
            }
            $data['end_time'] = date('Y-m-d 23:59:59',strtotime($request->end_time));
        }
        $activity->update($data);
        return redirect()->route('activities.index')->with('success','修改活动成功');

    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return 'success'; //该字符串是返回给ajax 的状态
    }
}
