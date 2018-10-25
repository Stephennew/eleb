@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('eventprizes.update',[$eventprize]) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">奖品名称</label>
            <input type="text" name="name" class="form-control" value="{{ $eventprize->name }}">
        </div>
        <div class="form-group">
            <label for="">奖品详情</label>
            <input type="text" name="description" class="form-control" value="{{ $eventprize->description }}">
        </div>
        <div class="form-group">
            <label for="">活动名称</label>
            <select name="events_id" id="" class="form-control">
                <option value="">请选择活动</option>
                @foreach($data as $v)
                    <option value="{{ $v->id }}" @if($eventprize->events_id == $v->id) selected="selected" @endif>{{ $v->title }}</option>
                @endforeach
            </select>
        </div>
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <button class="btn btn-info">修改奖品</button>
    </form>
@endsection



