<?php

namespace App\Http\Controllers;

use App\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    public function login()
    {
        return view('session.login');
    }

    public function verify(Request $request)
    {
        $this->validate($request,[
           'name'=>'required',
           'password'=>'required',
           'captcha'=>'required|captcha',
        ],[
            'name.reuqired'=>'账号不能为空',
            'password.required'=>'密码不能为空',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码不正确',
        ]);
        //这里的Auth 直接去config/auth.php 文件中Providers（提供者）里面去找对应模型，获取该模型（模型与表对应）里面的数据进行验证
        if(Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->has('remember')))
        {
            return redirect()->intended(route('shopmanagers.index'))->with('success','登陆成功');
        }else{
            return back()->with('danger','用户名或密码错误')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();//推出登陆，删除session
        return redirect()->route('session.login')->with('success','安全推出');
    }

    public function edit(Request $request)
    {
        $admin = Admin::find($request->id);
        return view('session.edit',compact('admin'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
           'oldpassword'=>'required',
            'password'=>'required',
            'repassword'=>'required',
        ],[
            'oldpassword.required'=>'旧密码不能为空',
            'password.required'=>'新密码不能为空',
            'repassword.required'=>'确认密码不能为空'
        ]);
        $admin = Admin::find($request->id);
        if(Hash::check($request->oldpassword,$admin->password)){
            if($request->password == $request->repassword){
                $admin->where('id',$admin->id)->update(['password'=>bcrypt($request->password)]);
            }
        }
        Auth::logout();//删除session 退出
        return redirect()->route('session.login')->with('success','修改密码成功');
    }
}
