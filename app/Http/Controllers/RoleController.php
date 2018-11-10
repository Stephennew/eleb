<?php

namespace App\Http\Controllers;

use App\Model\Permission;
use App\Model\RoleHasPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(5);
        return view('role.list',compact('roles'));

    }

    public function create()
    {
        $permissions = Permission::all();
        return view('role.add',compact('permissions'));
    }

    public function store(Request $request)
    {
        $role = Role::create(['name'=>$request->name,'guard_name'=>'web']);
        //将多个权限同步到该角色
        //后面的参数可以是字符串，数组，集合，对象
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('role.index')->with('success','添加角色权限成功');
    }

    public function edit(Role $role)
    {
        if(!Auth::user()->can('/rbac/edit/{permission}')){
            return '没有权限';
        }
        $permissions = Permission::all();
        $roles = $role->permissions; //获取当前所有角色的所有权限
        return view('role.edit',compact('role','permissions','roles'));
    }

    public function update(Request $request,Role $role)
    {
        $role->update(['name'=>$request->name]);
        $role->syncPermissions($request->input('permission'));
        return redirect()->route('role.index')->with('success','更改角色权限成功');

    }

    public function destroy(Role $role)
    {
        if(!Auth::user()->can('/rbac/destroy/{permission}')){
            return '没有权限';
        }
        $role->delete();
        return 'success';
    }
}
