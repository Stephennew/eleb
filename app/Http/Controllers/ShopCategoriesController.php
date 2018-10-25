<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Model\ShopCategory;

class ShopCategoriesController extends Controller
{
    public function index()
    {
        $shopcates = ShopCategory::paginate(2);
        return view('shopcategories.list',compact('shopcates'));
    }

    public function create()
    {
        return view('shopcategories.create');
    }

    public function store(Request $request)
    {
        //验证数据
        //var_dump($_POST);exit;
        $this->validate($request,[
           'name'=>'required',
           'img'=>'required',
           'status'=>'required',
        ]);
        //$img_path = $request->file('img')->store('public/shopcategories');
        ShopCategory::create([
            'name'=>$request->name,
            'img'=>$request->img,
            'status'=>$request->status,
        ]);
        return redirect()->route('shopcates.index')->with('success','添加成功');
    }

    public function edit(Request $request,ShopCategory $shopcate)
    {
        return view('shopcategories.edit',compact('shopcate'));
    }
    
    public function update(Request $request,ShopCategory $shopcate)
    {
        //验证数据
        $this->validate($request,[
            'name'=>'required',
            'status'=>'required',
        ],[
            'name.required'=>'分类名称不能为空',
            'status.required'=>'分类状态不能为空',
        ]);
        $data = [
            'name'=>$request->name,
            'status'=>$request->status,
        ];
       if($request->img != null)
        {
            $this->validate($request,[
                'img'=>'required'
            ],[
                'img.required'=>'图片不能为空'
            ]);
            $data['img'] = $request->img;
        }
        $shopcate->update($data);
        return redirect()->route('shopcates.index')->with('success','修改成功');
    }

    public function destroy(ShopCategory $shopcate)
    {
        $shopcate->delete();
        //return redirect()->route('shopcates.index')->with('success','删除成功');
        return 'success';
    }
}
