@extends('layout.default')
@section('contents')
    @include('layout._errors')
    @include('vendor.ueditor.assets')
    @include('layout._notice')
    <form action="{{ route('activities.update',[$activity]) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">活动标题</label>
            <input type="text" name="title" class="form-control" value="{{ $activity->title }}">
        </div>
        <div class="form-group">
            <label for="">活动开始日期</label>
            <input type="text" name="old_start_time" class="form-control" value="{{ ($activity->start_time)}}" disabled="disabled">
        </div>
        <div class="form-group">
            <label for="">活动结束日期</label>
            <input type="text" name="old_end_time" class="form-control" value="{{ $activity->end_time }}" disabled="disabled">
        </div>
        <div class="form-group">
            <label for="">修改活动开始日期</label>
            <input type="date" name="start_time" class="form-control" value="{{ old('start_time') }}">
        </div>
        <div class="form-group">
            <label for="">修改活动结束日期</label>
            <input type="date" name="end_time" class="form-control"  value="{{ old('end_time') }}">
        </div>
        <!-- 编辑器容器 -->
        <label for="">活动内容</label>
        <script id="container" name="content" type="text/plain">{!! $activity->content !!}</script>
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <button class="btn btn-info">确定修改</button>
    </form>
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>
@endsection
