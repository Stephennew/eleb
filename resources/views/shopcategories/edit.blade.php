@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('shopcates.update',$shopcate) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">商家分类名称</label>
            <input type="text" name="name" class="form-control" value="{{ $shopcate->name }}">
        </div>
        <div class="form-group">
            <label for="">修改商家分类图片</label>
            <input type="file" name="img">
            <img src="{{ \Illuminate\Support\Facades\Storage::url($shopcate->img) }}" alt="商家分类图片">
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
@endsection


