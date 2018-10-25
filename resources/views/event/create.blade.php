@extends('layout.default')
@section('contents')
    <form action="{{ route('events.store') }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">抽奖活动标题</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="">抽奖活动内容</label>
            <textarea name="content" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="">报名开始时间</label>
            <input type="date" name="signup_start" class="form-control" value="{{ old('signup_start') }}">
        </div>
        <div class="form-group">
            <label for="">报名结束时间</label>
            <input type="date" name="signup_end" class="form-control" value="{{ old('signup_end') }}">
        </div>
        <div class="form-group">
            <label for="">开奖日期</label>
            <input type="date" name="prize_date" class="form-control" value="{{ old('prize_date') }}">
        </div>
        <div class="form-group">
            <label for="">报名人数限制</label>
            <input type="text" name="signup_num" class="form-control" value="{{ old('signup_num') }}">
        </div>
       {{-- <label for="">请选择抽奖活动奖品</label>
        <div class="form-group">
            <select name="event_prizes_id" id="">
                @foreach($prizes as $v)
                    <option value="{{ $v->id }}">{{ $v->name }}</option>
                @endforeach
            </select>
        </div>--}}
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
        <button class="btn btn-info">添加抽奖</button>
    </form>
@endsection

