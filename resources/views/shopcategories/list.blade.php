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
                <td><img src="{{ \Illuminate\Support\Facades\Storage::url($shopcate->img) }}" alt=""></td>
                <td>{{ $shopcate->status}}</td>
                <td>
                    <a href="{{ route('shopcates.edit',[$shopcate]) }}" class="btn btn-warning">修改</a>
                    <form action="{{ route('shopcates.destroy',[$shopcate]) }}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <a href="" class="btn btn-danger">删除</a>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $shopcates->links() }}
@endsection