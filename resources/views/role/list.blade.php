@extends('layout.default')
@section('contents')
    <table class="table table-bordered">
        <tr>
            <td>名称</td>
            <td>描述</td>
            <td>操作</td>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td>{{ $role->name }}</td>
                <td>{{ $role->guard_name }}</td>
                <td>
                    <a href="{{ route('role.edit',[$role]) }}" class="btn btn-warning">修改</a>
                    <a href="javascript:;" data-href="{{ route('role.destroy',[$role]) }}" class="del_btn btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
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