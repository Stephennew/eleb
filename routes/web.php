<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//shopscate route
Route::resource('shopcates','ShopCategoriesController');
//shops route
Route::resource('shopmanagers','ShopManagerController');

//后台商家信息审核
Route::get('shops/verify','ShopManagerController@verify')->name('shops.verify');
Route::post('shops/verifystore','ShopManagerController@verifyStore')->name('shops.verifystore');

//后台添加商家信息及用户信息
Route::get('register','ShopManagerController@register')->name('register');
Route::post('register/store','ShopManagerController@registerStore')->name('register.store');

//admin route
Route::resource('admins','AdminController');
//user route
Route::resource('users','UserController');
//users 审核
Route::get('verify','UserController@verify')->name('verify');
Route::post('verify/store','UserController@verifyStore')->name('verify.store');
//重置商家密码
Route::get('reset','UserController@reset')->name('reset');
//session route
Route::get('session/login','SessionController@login')->name('session.login');
Route::post('session/verify','SessionController@verify')->name('session.verify');
Route::get('session/logout','SessionController@logout')->name('session.logout');
Route::get('session/edit','SessionController@edit')->name('session.edit');
Route::post('session/store','SessionController@store')->name('session.store');

//activity route
Route::resource('activities','ActivityController');

//upload route
Route::post('/upload','UploaderController@Upload')->name('upload');
//oss route
//Route::get('/oss',function (){
    //$client = App::make('aliyun-oss');
    /*$client->putObject(getenv('OSS_BUCKET'), "1.txt","你好");
    $result = $client->getObject(getenv('OSS_BUCKET'), "1.txt");
    echo $result;*/
    //try{
        //D:\www\eleb\public\storage\shopcategories\aXJ4AgyIzwyfZcIWMSsGTpubIgDL9ScMRYR1HeK4.png
        //D:\www\eleb\storage\app\public\shopcategories\aXJ4AgyIzwyfZcIWMSsGTpubIgDL9ScMRYR1HeK4.png
        //$client->uploadFile(getenv('OSS_BUCKET'),'public\shopcategories\aXJ4AgyIzwyfZcIWMSsGTpubIgDL9ScMRYR1HeK4.png',storage_path(
         //   'app\public\shopcategories\aXJ4AgyIzwyfZcIWMSsGTpubIgDL9ScMRYR1HeK4.png'));
       // echo '上传成功';

        //其他地方要访问OSS中的内容拼接  https://laravel-elebshop.oss-cn-beijing.aliyuncs.com/
   // }catch (\OSS\Core\OssException $e){
      //  echo '上传失败';
     //   printf($e->getMessage() . "\n");
    //}
//});

//events route
Route::resource('events','EventController');

//抽奖
Route::get('events/lottery/{event}','EventController@lottery')->name('events.lottery');

//event_prizes route
Route::resource('eventprizes','EventPrizeController');

//event_members route
Route::get('eventmembers','EventMemberController@index');

//member route
Route::prefix('member')->group(function (){
    Route::get('index','MemberController@index')->name('member.index');
    Route::get('view/{id}','MemberController@view')->name('member.view');
    Route::get('disable/{id}','MemberController@disable')->name('member.disable');
});

Route::prefix('index')->group(function (){
   Route::get('orders','IndexController@orders')->name('index.orders');
   Route::get('shops','IndexController@shops')->name('index.shops');
});