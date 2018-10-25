<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //构建中间件
    public function __construct()
    {
        $this->middleware('auth',[

        ]);
    }
    public function index()
    {
        $users = User::paginate(1);
        return view('user.list',compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('users.index')->with('success','添加账户信息成功');
    }

    public function edit()
    {
        
    }

    public function update()
    {
        
    }

    public function show()
    {

    }

    public function destroy(User $user)
    {
        $user->delete();
        return 'success';
    }

    //审核账号是否可用
    public function verify(Request $request)
    {
        $user = User::find($request->id);
        return view('user.verify',compact('user'));
    }

    public function verifyStore(Request $request)
    {
        User::where('id',$request->id)->update(['status'=>$request->status]);
        return redirect()->route('users.index')->with('success','审核成功');
    }

    //重置商家密码
    public function reset(Request $request)
    {
        $user = User::find($request->id);
        $user->password = bcrypt('666666');//重置之后默认密码为666666
        $user->save();
        return redirect()->route('users.index')->with('success','重置密码成功，这次一定要记住密码哦');
    }
}
