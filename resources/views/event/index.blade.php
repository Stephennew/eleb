@extends('layout.default')
@section('contents')
    @include('layout._notice')
    <a href="{{ route('events.create') }}" class="btn btn-info">添加抽奖活动</a>
    <table class="table table-bordered">
        <tr>
            <td>编号</td>
            <td>抽奖活动标题</td>
            <td>抽奖活动内容</td>
            <td>抽奖活动报名开始时间</td>
            <td>抽奖活动报名结束时间</td>
            <td>开奖日期</td>
            <td>报名人数</td>
            <td>是否开奖</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
            <tr>
                <td>{{ $v->id }}</td>
                <td>{{ $v->title }}</td>
                <td>{{ $v->content }}</td>
                <td>{{ date('Y-m-d',$v->signup_start) }}</td>
                <td>{{ date('Y-m-d',$v->signup_end) }}</td>
                <td>{{ date('Y-m-d',strtotime($v->prize_date)) }}</td>
                <td>{{ $v->signup_num }}</td>
                <td>{{ $v->is_prize }}</td>
                <td>
                    <a href="{{ route('events.edit',[$v]) }}" class="btn btn-warning">修改</a>
                    <a href="javascript:;" data-href="{{ route('events.destroy',[$v]) }}" class="del_btn btn btn-danger">删除</a>
                    <a href="{{ route('events.lottery',[$v]) }}" class="btn btn-info">抽奖</a>
                </td>

            </tr>
        @endforeach
    </table>
    {{ $data->links() }}
    <script src="/js/jQuery.js"></script>
    <script>
        $('.del_btn').click(function () {
            if(confirm('你确定要删除么？删除后不可恢复')){
                var btn = $(this);
                var url = btn.data('href');
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
                })
            }

        })
    </script>
@endsection

