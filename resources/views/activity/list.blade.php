@extends('layout.default');
@section('contents')
    <form action="{{ route('activities.index') }}" method="post" enctype="multipart/form-data">
            <select name="activities_status" id="" class="form-control">
                <option value="">请选择</option>
                <option value="1">未开始</option>
                <option value="2">进行中</option>
                <option value="3">已结束</option>
            </select>
        <div class="form-group">
            <label for="">请输入搜索的关键字</label>
            <input type="text" name="keywords" class="form-control">
        </div>
        {{csrf_field()}}
        {{method_field('GET')}}
        <button class="btn btn-info">搜索</button>
    </form>
    <table class="table table-bordered">
        <tr>
            <td>编号</td>
            <td>活动标题</td>
            <td>活动内容</td>
            <td>活动开始时间</td>
            <td>活动结束时间</td>
            <td>操作</td>
        </tr>
        @foreach($activities as $activity)
            <tr>
                <td>{{ $activity->id }}</td>
                <td>{{ $activity->title }}</td>
                {{--去掉 HTML 及 PHP 的标记--}}
                <td>{!! $activity->content !!}</td>
                <td>{{ $activity->start_time }}</td>
                <td>{{ $activity->end_time }}</td>
                <td>
                    <a href="{{ route('activities.edit',[$activity]) }}" class=" btn btn-warning">修改</a>
                    <a href="javascript:;" data-href="{{ route('activities.destroy',[$activity]) }}" class="btn-del btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('activities.create') }}" class="btn btn-info">添加数据</a><br>
    {{ $activities->appends(['keywords'=>$keywords,'activities_status'=>$activities_status])->links() }} {{--分页工具--}}

    <script src="/js/jQuery.js"></script>
    <script>
        $('btn-del').on('click',function (){
            if(confirm('你确定要删除？删除后不可恢复！')){
                var btn = $(this); //获取当前对象，即谁出发的事件谁就是该对象，装换成jquery 对象，方便调用jquery 对象上面的方法
                var url = btn.data('href'); //data函数可以访问html 标签的以data 定义的属性的值
                $.ajax({
                    type:'DELETE',
                    url:url,
                    data:{
                        _token:"{{ csrf_token() }}",
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
        });
    </script>
@endsection

