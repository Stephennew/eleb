@extends('layout.default')
@section('contents')
    @include('layout._notice')
    <a href="{{ route('users.create') }}">添加商家用户</a>
    <table class="table table-responsive">
        <tr>
            <td>编号</td>
            <td>用户名</td>
            <td>邮箱</td>
            <td>状态</td>
            <td>所属商家</td>
            <td>创建时间</td>
            <td>更新时间</td>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>@if($user->status) 启用 @else 禁用 @endif</td>
                <td>{{ $user->shop_id }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_id }}</td>
                <td>
                    <a href="{{ route('verify',['id'=>$user->id]) }}" class="btn btn-info">审核</a>
                    <a href="{{ route('reset',['id'=>$user->id]) }}" class="btn btn-danger">重置密码</a>
                    <a href="{{ route('users.edit',[$user]) }}" class="btn btn-warning">修改</a>
                    <form action="{{ route('users.destroy',[$user]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $users->links() }}
@endsection

