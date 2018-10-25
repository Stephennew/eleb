@extends('layout.default')
@section('contents')
    @include('layout._notice')
    @include('layout._errors')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <form action="{{ route('shopcates.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">商家分类名称</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <input type="hidden" name="img" class="form-control" id="img" value="{{ old('img') }}">
        </div>
        <div class="form-group">
            {{--<label for="">商家分类图片</label>
            <input type="file" name="img">--}}
            <!--dom结构部分-->
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>
                </div>
                <img src="" alt="" id="huixian" value="{{ old('huixian') }}" height="50px">
        </div>
        <label for="">商家分类状态</label>
        <div class="radio">
            <label for="">
                <input type="radio" name="status" value="1" checked="checked">显示
            </label>
            <label for="">
                <input type="radio" name="status" value="2">隐藏
            </label>
        </div>
        {{csrf_field()}}
        <button class="btn btn-info">添加分类</button>
    </form>
    <script type="text/javascript" src="/js/JQuery.js"></script>
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            swf:'/webuploader/Uploader.swf',

            // 文件接收服务端。//就是传到哪一个控制器哪一个方法接收
            server: '{{ route('upload') }}',
            formData:{//表单数据
                _token:"{{csrf_token()}}"
            },
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            //文件按钮
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },

        });
        //事件监听
        uploader.on( 'uploadSuccess', function( file,response ) {
            //$( '#'+file.id ).addClass('upload-state-done');
            $('#huixian').attr('src',response.url);
            $('#img').val(response.url);
        });

    </script>
@stop
