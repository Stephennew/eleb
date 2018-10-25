@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <form action="{{ route('shopcates.update',$shopcate) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">商家分类名称</label>
            <input type="text" name="name" class="form-control" value="{{ $shopcate->name }}">
        </div>
        <input type="hidden" value="" name="img" id="img" value="{{ old('img') }}">
        <div class="form-group">
            <label for="">修改商家分类图片</label>
            <!--dom结构部分-->
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
            </div>
            <img src="" alt="" height="50px" id="huixian" value="{{ old('img') }}">
        </div>
        <div class="form-group">
            <label for="">以前的图片</label>
            <img src="{{ $shopcate->img }}" alt="商家分类图片" height="50px">
        </div>
        <label for="">商家分类状态</label>
        <div class="radio">
            <label for="">
                <input type="radio" name="status" value="@if($shopcate->status) {{$shopcate->status}} @else 1 @endif" @if($shopcate->status) checked="checked"@endif>显示
            </label>
            <label for="">
                <input type="radio" name="status" value="@if(!$shopcate->status) {{$shopcate->status}} @else 0 @endif" @if(!$shopcate->status) checked="checked"@endif>隐藏
            </label>
        </div>
        {{csrf_field()}}
        {{ method_field('PUT') }}
        <button class="btn btn-info">提交</button>
    </form>
    <script src="/js/jQuery.js"></script>
    <!--引入JS-->
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            swf:'/js/Uploader.swf',

            // 文件接收服务端。
            server: '{{ route('upload') }}',
            formData:{
              _token:"{{ csrf_token() }}",
            },
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        //事件监听
        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file,response ) {
            $('#huixian').attr('src',response.url);
            $('#img').val(response.url);
        });
    </script>
@endsection


