<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Model\ShopCategory;

class ShopCategories extends Controller
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
        $img_path = $request->file('img')->store('public/shopcategories');
        ShopCategory::create([
            'name'=>$request->name,
            'img'=>$img_path,
            'status'=>$request->status,
        ]);
        return redirect()->route('shopcate.index')->with('success','添加成功');
    }

    public function edit(Request $request,ShopCategory $shopcate)
    {
        return view('shopcategories.edit',compact('shopcate'));
    }
    
    public function update(Request $request,ShopCategory $shopcate)
    {
        //验证数据

        $data = [
            'name'=>$request->name,
            'status'=>$request->status,
        ];
        if($request->has('img') != null)
        {
            $this->validate($request,[
                'img'=>'required|image'
            ],[
                'img.required'=>'图片'
            ]);
            $data['img'] = $request->file('img')->store('public/shopcategories');
        }
        $shopcate->update($data);
        return redirect()->route('shopcates.index')->with('success','修改成功');
    }

    public function destroy(ShopCategory $shopcate)
    {
        $shopcate->delete();
        return redirect()->route('shopcates.index')->with('success','删除成功');
    }
}
