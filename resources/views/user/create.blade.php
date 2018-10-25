@extends('layout.default')
@section('contents')
    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">用户名</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="">密码</label>
            <input type="text" name="password" class="form-control" value="{{ old('password') }}">
        </div>
        {{ csrf_field() }}
        <button class="btn btn-info">注册</button>
    </form>
@endsection
