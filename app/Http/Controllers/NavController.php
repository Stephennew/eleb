<?php

namespace App\Http\Controllers;

use App\Model\Nav;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class NavController extends Controller
{
    public function index()
    {
        $menus = Nav::paginate(5);
        return view('nav.list',compact('menus'));
    }

    public function create()
    {
        //所有菜单分类
        $menus_cates = Nav::all();
        //所有权限
        $permissions = Permission::all();
        return view('nav.add',compact('permissions','menus_cates'));
    }

    public function store(Request $request)
    {
        //验证数据
        $this->validate($request,[
           'name'=>'required',
            'pid'=>'required',
        ],[
            'name.required'=>'菜单名称不能为空',
            'pid.required'=>'上级分类不能为空',
        ]);
        $data = [
            'name'=>$request->name,
            'pid'=>$request->pid,
        ];

        if(!($request->pid == 0)){
            $this->validate($request,[
                'url'=>'required',
            ],[
                'url.required'=>'路由不能为空',
            ]);
            //根据权限名获取该权限的ID
            $permission_id = Permission::findByName($request->url)->id;
            $data['url'] = $request->url;
            $data['permission_id'] = $permission_id;
        }
        //写入数据
        Nav::create($data);
        return redirect()->route('nav.index')->with('success','添加菜单成功');
    }

    public function edit()
    {
        
    }

    public function update()
    {
        
    }

    public function destroy()
    {
        
    }
}
