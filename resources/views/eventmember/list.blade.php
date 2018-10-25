@extends('layout.default')
@section('contents')

    <table class="table table-bordered">
        <tr>
            <td>编号</td>
            <td>抽奖活动名称</td>
            <td>报名商家名称</td>
        </tr>
        @foreach($eventmembers as $eventmember)
            <tr>
                <td>{{ $eventmember->id }}</td>
                <td>{{ $eventmember->events_id }}</td>
                <td>{{ $eventmember->member_id }}</td>
            </tr>
        @endforeach
    </table>
@endsection

