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
                    {{--<form action="{{ route('admins.destroy',[$admin]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger">删除</button>
                    </form>--}}
                    <a href="javascript:;" data-href="{{ route('admins.destroy',[$admin]) }}" class="del_btn btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $admins->links() }}
    <script src="/js/jQuery.js"></script>
    <script>
        $('.del_btn').click(function () {
            var btn = $(this);
            var url = btn.data('href');
            if(confirm('你确定要删除么？删除后不可恢复！')){
                $.ajax({
                    type:'DELETE',
                    url:url,
                    data:{
                        _token:"{{ csrf_token() }}"
                    },
                    success:function (msg) {
                        if(msg == 'success'){
                            alert('删除成功');
                            btn.closest('tr').fadeout();
                        }else{
                            alert('删除失败');
                        }
                    }
                });
            }
        });
    </script>
@endsection
