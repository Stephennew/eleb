@extends('layout.default')
@section('contents')
    <form action="{{ route('admins.update',[$admin]) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">用户名</label>
            <input type="text" name="name" value="{{ $admin->name }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="">旧密码</label>
            <input type="text" name="oldpassword" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="">新密码</label>
            <input type="text" name="password" value=""  class="form-control">
        </div>
        <div class="form-group">
            <label for="">确认密码</label>
            <input type="text" name="repassword" value=""  class="form-control">
        </div>
        <div class="form-group">
            <label for="">邮箱</label>
            <input type="text" name="email" value="{{ $admin->name }}"  class="form-control">
        </div>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <button class="btn btn-info">提交</button>
    </form>
@endsection
