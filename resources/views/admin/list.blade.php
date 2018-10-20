@extends('layout.default')
@section('contents')
    @include('layout._notice')
    <a href="{{ route('admins.create') }}" class="btn btn-info">添加平台管理员</a>
    <table class="table table-bordered">
        <tr>
            <td>编号</td>
            <td>账户名</td>
            <td>邮箱</td>
            <td>创建时间</td>
            <td>更新时间</td>
            <td>操作</td>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->created_at }}</td>
                <td>{{ $admin->updated_at }}</td>
                <td>
                    <a href="{{ route('admins.edit',[$admin]) }}" class="btn btn-warning">修改</a>
                    <form action="{{ route('admins.destroy',[$admin]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $admins->links() }}
@endsection
