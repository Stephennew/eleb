<?php

namespace App\Http\Controllers;

use App\Model\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $keywords = $request->keywords?$request->keywords:'';
        $members = Member::paginate(1);
        if($keywords){
            $members = Member::where(function ($query) use ($keywords){
                $query->where('username','like','%'.$keywords.'%')
                    ->orwhere('tel','like','%'.$keywords.'%');
            })->paginate(1);
        }
        return view('member.list',compact('members','keywords'));
    }

    public function view(Member $id)
    {
        return view('member.view',compact('id'));
    }

    public function disable(Member $id)
    {
        Member::where('id',$id->id)->update(['status'=>0]);
        return redirect()->route('member.index')->with('success',$id->username.'已禁用成功');
    }
}
