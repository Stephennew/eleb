@extends('layout.default')
@section('contents')
    @include('layout._notice')
    <table class="table table-bordered">
        <tr>
            <td>编号</td>
            <td>店铺分类</td>
            <td>店铺名称</td>
            <td>店铺图片</td>
            <td>店铺评分</td>
            <td>是否是品牌</td>
            <td>是否准时送达</td>
            <td>是否蜂鸟配送</td>
            <td>是否保标记</td>
            <td>是否票标记</td>
            <td>是否准标记</td>
            <td>起送金额</td>
            <td>配送费</td>
            <td>优惠信息</td>
            <td>起送金额</td>
            <td>商铺状态</td>
            <td>操作</td>

        </tr>
        @foreach($shops as $shop)
            <tr>

                <td>{{ $shop->id }}</td>
                <td>{{ $shop->shopcate->name }}</td>
                <td>{{ $shop->shop_name }}</td>
                <td><img src="{{\Illuminate\Support\Facades\Storage::url($shop->shop_img)}}" alt=""></td>
                <td>{{ $shop->shop_rating }}</td>
                <td>{{ $shop->brand }}</td>
                <td>{{ $shop->on_time }}</td>
                <td>{{ $shop->fengniao }}</td>
                <td>{{ $shop->bao }}</td>
                <td>{{ $shop->piao }}</td>
                <td>{{ $shop->zhun }}</td>
                <td>{{ $shop->start_send }}</td>
                <td>{{ $shop->send_cost }}</td>
                <td>{{ $shop->notice }}</td>
                <td>{{ $shop->discount }}</td>
                <td>@if($shop->status) 正常 @elseif(!$shop->status) 待审核 @else 禁用 @endif</td>
                <td>
                    <a href="{{ route('shops.verify',['id'=>$shop->id]) }}" class="btn btn-info">商家信息审核</a>
                    <a href="{{ route('shopmanagers.edit',[$shop]) }}" class="btn btn-warning">修改</a>
                    <form action="{{ route('shopmanagers.destroy',[$shops]) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <a href="" class="btn btn-danger">删除</a>
                    </form>

                </td>
            </tr>

        @endforeach
    </table>
    {{ $shops->links() }}
@endsection