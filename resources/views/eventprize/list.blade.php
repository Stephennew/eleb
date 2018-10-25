@extends('layout.default')
@section('contents')
    @include('layout._notice')
    <a href="{{ route('eventprizes.create') }}" class="btn btn-info">添加活动奖品</a>
    <table class="table table-bordered">
        <tr>
            <td>奖品编号</td>
            <td>所属活动</td>
            <td>奖品名称</td>
            <td>奖品详情</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
            <tr>
                <td>{{ $v->id }}</td>
                <td>{{ $v->prizes->title }}</td>
                <td>{{ $v->name }}</td>
                <td>{{ $v->description }}</td>
                <td>
                    @if($v->prizes->prize_date > $totime)
                        <a href="{{ route('eventprizes.edit',[$v]) }}" class="btn btn-warning">修改</a>
                        <a href="javascript:;" data-href="{{ route('eventprizes.destroy',[$v]) }}" class="del_btn btn btn-danger">删除</a>
                    @elseif($v->prizes->prize_date < time())
                        <a href="{{ route('eventprizes.edit',[$v]) }}" class="btn btn-warning disabled">开奖已结束</a>
                    @endif


                </td>
            </tr>
        @endforeach
    </table>
    {{ $data->links()}}
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
                       if('success' == msg){
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

