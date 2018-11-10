@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('nav.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">菜单名称</label>
            <input type="text" name="name" class="form-control">
        </div>
        <label for="">上级菜单</label>
        <div class="form-group">
            <select name="pid" id="" class="form-control">
                <option value="">请选择菜单</option>
                <option value="0">顶级菜单</option>
                @foreach($menus_cates as $menus_cate)
                    <option value="{{ $menus_cate->id }}">{{ $menus_cate->name }}</option>
                @endforeach
            </select>
        </div>
        <label for="">地址/路由</label>
        <div class="form-groupr">
            <select name="url" id="" class="form-control">
                <option value="">请选择路由</option>
                @foreach($permissions as $permission)
                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-info">添加菜单</button>
    </form>
@endsection

