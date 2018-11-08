<?php

namespace App\Http\Controllers;

use App\Model\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::paginate(3);
        return view('admin.list',compact('admins'));
    }

    public function create()
    {
        //获取所有角色
        $roles = Role::all();
        return view('admin.create',compact('roles'));
    }

    public function store(Request $request)
    {
        //验证
        $this->validate($request,[
           'captcha'=>'required|captcha',
            'roles'=>'required'
        ],[
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码不正确',
            'roles.required'=>'必须选择角色'
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
        $admin = Admin::create($data);
        $admin->assignRole($request->roles);
        return redirect()->route('admins.index')->with('success','注册成功');

    }

    public function edit(Admin $admin)
    {
        $roles = Role::all();
        $admin_roles = $admin->roles;//获取当前用户具有的所有角色
        return view('admin.edit',compact('admin','roles','admin_roles'));
    }

    public function update(Request $request,Admin $admin)

    {
        //验证
        $this->validate($request,[
           'roles'=>'required',
        ],[
            'roles.required'=>'角色不能为空'
        ]);
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
        $admin->assignRole($request->roles);
        return redirect()->route('admins.index')->with('success','修改用户信息成功');

    }

    public function show()
    {

    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return 'success';
        //return redirect()->route('admins.index')->with('success','删除成功');
    }
}
