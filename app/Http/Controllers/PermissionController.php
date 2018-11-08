<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Model;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(5);
        return view('permission.list',compact('permissions'));
    }

    public function create()
    {
        return view('permission.add');
    }

    public function store(Request $request)
    {
        Permission::create($request->input());
        return redirect()->route('rbac.list')->with('success','添加权限成功');
    }

    public function edit(Model\Permission $permission)
    {
        return view('permission.edit',compact('permission'));
    }

    public function update(Request $request,Model\Permission $permission)
    {
        $permission->update($request->input());
        return redirect()->route('rbac.list')->with('success','修该权限成功');
    }

    public function destroy(Model\Permission $permission)
    {
        $permission->delete();
        return 'success';
    }

}
