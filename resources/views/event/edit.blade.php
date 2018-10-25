@extends('layout.default')
@section('contents')
    <form action="{{ route('events.update',[$event]) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">抽奖活动标题</label>
            <input type="text" name="title" class="form-control" value="{{ $event->title }}">
        </div>
        <div class="form-group">
            <label for="">抽奖活动内容</label>
            <textarea name="content" id="" cols="30" rows="10">{{ $event->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="">修改报名开始时间</label>
            <input type="date" name="signup_start" class="form-control">
        </div>
        <div class="form-group">
            <label for="">报名开始时间</label>
            <input type="text" name="old_signup_start" class="form-control" value="{{ date('Y-m-d H:i:s',$event->signup_start) }}" id="signup_start">
        </div>
        <div class="form-group">
            <label for="">修改报名结束时间</label>
            <input type="date" name="signup_end" class="form-control">
        </div>
        <div class="form-group">
            <label for="">报名结束时间</label>
            <input type="text" name="old_signup_end" class="form-control" value="{{ date('Y-m-d H:i:s',$event->signup_end) }}">
        </div>
        <div class="form-group">
            <label for="">修改开奖日期</label>
            <input type="date" name="prize_date" class="form-control">
        </div>
        <div class="form-group">
            <label for="">开奖日期</label>
            <input type="text" name="old_prize_date" class="form-control" value="{{ $event->prize_date }}">
        </div>
        <div class="form-group">
            <label for="">报名人数限制</label>
            <input type="text" name="signup_num" class="form-control" value="{{ $event->signup_num }}">
        </div>
        <label for="">是否已开奖</label>
        <div class="radio">
            <label for="">
                <input type="radio" class="radio" name="is_prize" value="0" checked="checked"> 否
            </label>
            <label for="">
                <input type="radio" class="radio" name="is_prize" value="0" > 是
            </label>
        </div>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <button class="btn btn-info">修改抽奖活动</button>
    </form>
    <script src="/js/jQuery.js"></script>
    <script>
        /*var now = new Date();
        alert(now.getDate()+'-'+now.getMonth());
        //格式化日，如果小于9，前面补0
        var day = ("0" + now.getDate()).slice(-2);
        //格式化月，如果小于9，前面补0
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        //拼装完整日期格式
        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
        //完成赋值
        $('#createStartTime').val(today);*/
        //$("#signup_start")[0].value = nowDate();
        // 获取当前时间
        /*function nowDate(){
            //var times = date('Y-m-d H:i:s',{{--{{$event->signup_end}}--}});
            //return times;
            return now = new Date();     // 当前日期
            if((times.getMonth() + 1) < 10){
                if(times.getDate()<10){
                    // 当前日期
                    today = times.getFullYear() + '-' +'0' + (times.getMonth() + 1) + '-' +'0' + times;
                }else{
                    // 当前日期
                    today = times.getFullYear() + '-' +'0' + (times.getMonth() + 1) + '-' + times;
            }else{
                if(times.getDate()<10){
                    // 当前日期
                    today = times.getFullYear() + '-' + (times.getMonth() + 1) + '-' +'0' + times;
                }else{
                    // 当前日期
                    today = times.getFullYear() + '-' + (times.getMonth() + 1) + '-' + times;
                }
            }
            //console.log("today is day--->" + today);
            return today;
        }
        $("#signup_start").val(nowDate());*/
    </script>
@endsection

