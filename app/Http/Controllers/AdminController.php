<?php

namespace App\Http\Controllers;

use App\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::paginate(1);
        return view('admin.list',compact('admins'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        //验证
        $this->validate($request,[
           'captcha'=>'required|captcha',
        ],[
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码不正确'
        ]);
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'captcha'=>$request->captcha,
            'remember_token'=>str_random(40),
        ];
        if($request->password === $request->repassword){
            $data['password'] = bcrypt($request->password);
        }
        Admin::create($data);
        return redirect()->route('admins.index')->with('success','注册成功');

    }

    public function edit(Admin $admin)
    {
        return view('admin.edit',compact('admin'));
    }

    public function update(Request $request,Admin $admin)

    {
        $data = [
          'name'=>$request->name,
          'email'=>$request->email,
            'captcha'=>$request->email,
        ];
        if(Hash::check($request->oldpassword,$admin->password)){//通过laravel 的Hash::check() 可以检验
            if($request->password == $request->repassword){
                $data['password'] = bcrypt($request->password);
            }
        }
        $admin->update($data);
        return redirect()->route('admins.index')->with('success','修改用户信息成功');

    }

    public function show()
    {

    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('success','删除成功');
    }
}
