@extends('layout.default')
@section('contents')
    <h2>商家账状态审核</h2>
    <form action="{{ route('verify.store',['id' => $user->id]) }}" method="post">
        <div class="form-group">
            <label for="">用户名</label>
            <input type="text" name="name" class="form-control" value="{{ $user['name'] }}">
        </div>
        <label for="">账号状态</label>
        <div class="radio">
            <label for="">
                <input type="radio" name="status" value="1" @if($user['status']) checked="checked" @endif>启用
            </label>
            <label for="">
                <input type="radio" name="status" value="0" @if(!$user['status']) checked="checked" @endif>禁用
            </label>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-info">提交审核</button>
    </form>
@endsection


