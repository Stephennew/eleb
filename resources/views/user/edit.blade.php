@extends('layout.default')
@section('contents')
    <form action="{{ route('users.update',[$user]) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">用户名</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="">邮箱</label>
            <input type="text" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="">所属商家</label>
            <input type="text" name="shop_id" class="form-control">
        </div>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <button class="btn btn-info">提交</button>
    </form>
@endsection
