@extends('layout.default')
@section('contents')
    @include('layout._notice')
    <h3>菜单列表</h3>
    <table class="table table-responsivee">
        <tr>
            <td>菜单名称</td>
            <td>菜单URL</td>
            <td>菜单级别</td>
            <td>操作</td>
        </tr>
        @foreach($menus as $menu)
            <tr>
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->url }}</td>
                <td>{{ $menu->pid }}</td>
                <td>
                    <a href="{{ route('nav.edit',[$menu]) }}" class="btn btn-warning">修改菜单</a>
                    <a href="{{ route('nav.destroy',[$menu]) }}" class="btn btn-danger">删除菜单</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
