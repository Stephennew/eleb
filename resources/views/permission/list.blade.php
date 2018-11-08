@extends('layout.default')
@section('contents')
    @include('layout._notice')
    <a href="{{ route('rbac.add') }}" class="btn btn-info">添加权限</a>
    <table class="table table-bordered">
        <tr>
            <td>名称</td>
            <td>描述</td>
            <td>操作</td>
        </tr>
        @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->guard_name }}</td>
                <td>
                    <a href="{{ route('rbac.edit',[$permission]) }}" class="btn btn-warning">修改</a>
                    <a href="javascript:;" data-href="{{ route('rbac.destroy',[$permission]) }}" class="del_btn btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $permissions->links() }}
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

