@extends('layout.default')
@section('contents')
    <a href="{{ route('shopcates.create') }}" class="btn btn-info">添加数据</a>
    <table class="table table-bordered">
         <tr>
             <td>编号</td>
             <td>商家分类名称</td>
             <td>商家分类图片</td>
             <td>商家分类状态</td>
             <td>操作</td>
         </tr>
        @foreach($shopcates as $shopcate)
            <tr>
                <td>{{ $shopcate->id}}</td>
                <td>{{ $shopcate->name}}</td>
                <td><img src="{{ $shopcate->img }}" alt="" height="50px"></td>
                <td>{{ $shopcate->status}}</td>
                <td>
                    <a href="{{ route('shopcates.edit',[$shopcate]) }}" class="btn btn-warning">修改</a>
                   {{-- <form action="{{ route('shopcates.destroy',[$shopcate]) }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button class="btn btn-danger">删除</button>
                    </form>--}}
                    <a href="javascript:;" data-href="{{ route('shopcates.destroy',[$shopcate]) }}" class="del_btn btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $shopcates->links() }}
    <script src="/js/jQuery.js"></script>
    <script>
        $('.del_btn').on('click',function () {
           var btn = $(this);
           var url = btn.data('href');
           if(confirm('你确定要删除么，删除后不可恢复')){
               $.ajax({
                  type:'DELETE',
                  url:url,
                  data:{
                      _token:"{{csrf_token()}}"
                  },
                   success:function (msg) {
                       if($msg == 'success'){
                           alert('删除成功');
                           btn.closest('tr');
                       }else{
                           alert('删除失败');
                       }
                   }
               });
           }
        });
    </script>
@endsection