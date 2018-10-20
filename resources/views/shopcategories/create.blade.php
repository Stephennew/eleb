@extends('layout.default')
@section('contents')
    <form action="{{ route('shopcates.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">商家分类名称</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="">商家分类图片</label>
            <input type="file" name="img">
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
@stop