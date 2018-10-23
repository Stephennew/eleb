@extends('layout.default')
@section('contents')
    @include('layout._errors')
    @include('vendor.ueditor.assets')
    <form action="{{ route('activities.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">活动标题</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="">活动开始日期</label>
            <input type="date" name="start_time" class="form-control">
        </div>
        <div class="form-group">
            <label for="">活动结束日期</label>
            <input type="date" name="end_time" class="form-control">
        </div>
        <!-- 编辑器容器 -->
        <label for="">活动内容</label>
        <script id="container" name="content" type="text/plain"></script>
        {{ csrf_field() }}
        <button class="btn btn-info">发布</button>
    </form>
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@endsection