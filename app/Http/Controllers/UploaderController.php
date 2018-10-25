<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploaderController extends Controller
{
    public function upload(Request $request)
    {
        //
       /* try{
            $ossClient = new OssClient(getenv('OSS_ACCESS_KEY_ID'), getenv('OSS_ACCESS_KEY_SECRET'), getenv('OSS_ENDPOINT'));

            $ossClient->uploadFile(getenv('OSS_BUCKET'), $request->file('file'),storage_path('app/public'));
        } catch(OssException $e) {
            //printf(__FUNCTION__ . ": FAILED\n");
            printf($e->getMessage() . "\n");
            //return;
        }
        $path =$request->file('file')->store('public/pic');
        return ['url'=>url(Storage::url($path))];*/
        //Storage::disk('oss');//使用阿里云oss 存储图片
        //Storage::put('path/to/file/file.jpg', $contents); //first parameter is the target file path, second paramter is file content
        //将图片推到oss 存储对象空间去
        //Storage::put('\public\shopcategories\aXJ4AgyIzwyfZcIWMSsGTpubIgDL9ScMRYR1HeK4.png',file_get_contents(storage_path('\app\public\shopcategories\aXJ4AgyIzwyfZcIWMSsGTpubIgDL9ScMRYR1HeK4.png'))); // upload file from local path
        //return '上传成功';
        //echo Storage::url('\public\shopcategories\aXJ4AgyIzwyfZcIWMSsGTpubIgDL9ScMRYR1HeK4.png');
        $path = $request->file('file')->store('public/eleb'); //将本地上传的图片保存在 oss 对象存储
        return ['url'=>Storage::url($path)];//上传成功之后返回ajax 请求地址，将该地址保存在数据库
    }

}
