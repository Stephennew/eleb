<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use App\Model\ShopCategory;
use App\User;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopManagerController extends Controller
{
    public function index()
    {
        $shops = Shop::paginate(2);
        return view('shopmanager.list',compact('shops'));
    }

    public function create()
    {
        return view('shopmanager.create');
    }

    public function store(Request $request)
    {
        //验证
        $this->validate($request,[
           'shop_img'=>'required|image',
           'captcha'=>'required|captcha'
        ],[
            'shop_img.required'=>'必须上传店铺图片',
            'shop_img.image'=>'图片的格式不正确',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码不正确'
        ]);
        $shops_data=[
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>$request->shop_img,
            'brand'=>$request->has('brand') ?? 0,
            'on_time'=>$request->has('on_time') ?? 0,
            'fengniao'=>$request->has('fengniao') ?? 0,
            'piao'=>$request->has('piao') ?? 0,
            'zhun'=>$request->has('zhun') ?? 0,
            'bao'=>$request->has('bao') ?? 0,
            'status'=>'1',//商家信息默认为待审核，后台注册的不需要审核
        ];
        $users_data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'remember_token'=>str_random(40),
            'status'=>'1',//账号默认为禁用，需要审核，后台注册的不需要审核
        ];
        User::create($users_data);
        Shop::create($shops_data);
        return redirect()->route('shopmanagers.index')->with('success','添加商户成功');
    }

    public function edit(Shop $shopmanager)
    {
        return view('shopmanager.edit',compact('shopmanager'));
    }

    public function update(Request $request,Shop $shopmanager)
    {
        //验证
        $data = [
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_rating'=>$request->shop_rating,
            'brand'=>$request->has('brand') ?? 0,
            'on_time'=>$request->has('on_time') ?? 0,
            'fengniao'=>$request->has('fengniao') ?? 0,
            'bao'=>$request->has('bao') ?? 0,
            'piao'=>$request->has('piao') ?? 0,
            'zhun'=>$request->has('zhun') ?? 0,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'status'=>$request->status,
        ];
        if($request->has('shop_img')){

            $this->validate($request,[
               'shop_img'=>'image',
            ],[
                'shop_img.image'=>'图片格式不正确'
            ]);

            $data['shop_img'] = $request->file('shop_img')->store('public/shops');
        }

        $shopmanager->update($data);
        return redirect()->route('shopmanagers.index')->with('success','更新成功');

    }

    public function destroy(Shop $shopmanager)
    {
        $shopmanager->delete();
        return 'success';
        //return redirect()->route('shopmanagers.index')->with('success','删除成功');
    }

    public function show()
    {
        
    }

    //平台可以直接添加商家信息和账户，默认已审核通过
    public function register()
    {
        //获取所有的分类
        $data = ShopCategory::all();
        return view('shopmanager.register',compact('data'));
    }

    public function registerStore(Request $request)
    {
        $shop_img_path = $request->file('shop_img')->store('public/shops');
        $user_data = [
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
            'remember_token'=> str_random(40),
            'status'=>'1',
        ];
        $shops_data = [
            'shop_category_id'=>$request->shop_category_id,
            'shop_name'=>$request->shop_name,
            'shop_img'=>$shop_img_path,
            'brand'=>$request->has('brand') ?? 0,
            'on_time'=>$request->has('on_time') ?? 0,
            'fengniao'=>$request->has('fengniao') ?? 0,
            'piao'=>$request->has('piao') ?? 0,
            'zhun'=>$request->has('zhun') ?? 0,
            'bao'=>$request->has('bao') ?? 0,
            'status'=>'1'
        ];

        //同时写入数据库，做事务处理
        DB::transaction(function () use ($user_data,$shops_data){
            $shop = Shop::create($shops_data);
            $user_data['shop_id'] = $shop->id;
            User::create($user_data);
        });
        return redirect()->route('shopmanagers.index')->with('success','添加商家账号信息成功');
    }

    public function verify(Request $request)
    {
        $shop = Shop::find($request->id);
        return view('shopmanager.verify',compact('shop'));
    }

    public function verifyStore(Request $request)
    {
        $data = Shop::find($request->id);
        $data->where('id',$request->id)->update(['status'=>$request->status]);
        return redirect()->route('shopmanagers.index')->with('success','审核成功');

    }
}
