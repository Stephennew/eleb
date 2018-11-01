@extends('layout.default')
@section('contents')
    <div>
        <h2>用户编号：{{ $id->id }}</h2>
        <h2>用户名{{ $id->username }}</h2>
        <h2>用户电话{{ $id->tel }}</h2>
        <h2>用户加入时间{{ $id->created_at }}</h2>
        <h2>用户状态{{ $id->status }}</h2>
    </div>
@endsection

