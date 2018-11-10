@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('session.verify') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">管理员账号</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="">管理员密码</label>
            <input type="text" name="password" class="form-control" value="{{ old('password') }}">
        </div>
        <div class="checkbox">
                <label for="">
                    <input type="checkbox" name="remember">记住我
                </label>
        </div>
        <label for="">验证码</label>
        <input id="captcha" class="form-control" name="captcha" value="{{ old('captcha') }}">
        <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        {{ csrf_field() }}
        <button class="btn btn-info">登陆</button>
    </form>
@endsection


