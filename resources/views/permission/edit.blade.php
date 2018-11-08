@extends('layout.default')
@section('contents')
    <form action="{{ route('rbac.update',[$permission]) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">权限名称(路由)</label>
            <input type="text" name="name" value="{{ $permission->name }}" class="form-control">
        </div>
        {{ csrf_field() }}
        <button class="btn btn-info">提交更新</button>
    </form>
@endsection


