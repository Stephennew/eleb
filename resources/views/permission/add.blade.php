@extends('layout.default')
@section('contents')
    <form action="{{ route('rbac.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">权限名称</label>
            <input type="text" class="form-control" name="name">
        </div>
        {{ csrf_field() }}
        <button class="btn btn-info">添加权限</button>
    </form>
@endsection
