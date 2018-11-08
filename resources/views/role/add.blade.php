@extends('layout.default')
@section('contents')
    <form action="{{ route('role.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">角色名</label>
            <input type="text" class="form-control" name="name"/>
        </div>
        {{--将所有的权限遍历出来--}}
        <label for="">请选择权限</label>
        <div class="checkbox">
            @foreach($permissions as $permission)
                <label for="">
                    <input type="checkbox"  name="permission[]" value="{{ $permission->name }}">{{ $permission->name }}
                </label>
            @endforeach
        </div>
        {{ csrf_field() }}
        <button class="btn btn-info">添加角色</button>
    </form>
@endsection
