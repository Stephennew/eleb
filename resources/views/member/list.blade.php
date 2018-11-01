@extends('layout.default')
@section('contents')
    <form action="{{ route('member.index') }}" method="get">
        <div class="form-group">
            <input type="text" class=“”"" name="keywords">
            <button class="btn btn-info">搜索</button>
        </div>
    </form>
    <table class="table table-responsive">
        <tr>
            <td>用户编号</td>
            <td>用户名</td>
            <td>用户电话</td>
            <td>加入时间</td>
            <td>状态</td>
            <td>操作</td>
        </tr>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->username }}</td>
                <td>{{ $member->tel }}</td>
                <td>{{ $member->created_at }}</td>
                <td>{{ $member->status }}</td>
                <td>
                    <a href="{{ route('member.view',[$member]) }}" class="btn btn-info">查看详情</a>
                    <a href="{{ route('member.disable',[$member]) }}" class="btn btn-danger">禁用</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $members->appends(['keywords'=>$keywords])->links() }}
@endsection

