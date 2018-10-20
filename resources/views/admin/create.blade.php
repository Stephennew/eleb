@extends('layout.default')
@section('contents')
    <form action="{{ route('admins.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">用户名</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="">密码</label>
            <input type="text" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="">确认密码</label>
            <input type="text" name="repassword" class="form-control">
        </div>

        <div class="form-group">
            <label for="">邮箱</label>
            <input type="email" name="email" class="form-control">
        </div>
        <label for="">验证码</label>
        <input id="captcha" class="form-control" name="captcha" >
        <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        {{ csrf_field() }}
        <button class="btn btn-info">注册</button>
    </form>
@endsection

