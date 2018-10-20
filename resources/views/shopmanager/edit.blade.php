@extends('layout.default')
@section('contents')
    @include('layout._errors')
    <form action="{{ route('shopmanagers.update',[$shopmanager]) }}" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">店铺名称</label>
            <input type="text" name="shop_name" class="form-control" value="{{ $shopmanager->shop_name }}">
        </div>
        <div class="form-group">
            <label for="">店铺分类</label>
            <select name="shop_category_id" id="" class="form-control">
                <option value="1">{{ $shopmanager->shop_category_id }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">修改店铺图片</label>
            <input type="file" name="shop_img">
            <img src="{{ \Illuminate\Support\Facades\Storage::url($shopmanager->shop_img) }}" alt="">
        </div>
        <div class="form-group">
            <label for="">店铺评分</label>
            <input type="text" name="shop_rating" class="form-control" value="{{ $shopmanager->shop_rating }}">
        </div>
        <div class="checkbox">
            <label for="">
                <input type="checkbox" name="brand" value="{{ $shopmanager->brand }}" @if($shopmanager->brand) checked="checked" @endif>是否品牌
            </label>
        </div>
        <div class="checkbox">
            <label for="">
                <input type="checkbox" name="on_time" value="{{ $shopmanager->on_time }}" @if($shopmanager->on_time) checked="checked" @endif>是否准时送达
            </label>
        </div>
        <div class="checkbox">
            <label for="">
                <input type="checkbox" name="fengniao" value="{{ $shopmanager->fengniao }}" @if($shopmanager->fengniao) checked="checked" @endif>是否支持蜂鸟
            </label>
        </div>
        <div class="checkbox">
            <label for="">
                <input type="checkbox" name="bao" value="{{ $shopmanager->bao }}" @if($shopmanager->bao) checked="checked" @endif>是否保标记
            </label>
        </div>
        <div class="checkbox">
            <label for="">
                <input type="checkbox" name="piao" value="{{ $shopmanager->piao }}" @if($shopmanager->piao) checked="checked" @endif>是否票标记
            </label>
        </div>
        <div class="checkbox">
            <label for="">
                <input type="checkbox" name="zhun" value="{{ $shopmanager->zhun }}" @if($shopmanager->zhun) checked="checked" @endif>是否准标记
            </label>
        </div>
        <div class="form-group">
            <label for="">起送金额</label>
            <input type="text" name="start_send" class="form-control" value="{{ $shopmanager->start_send }}">
        </div>
        <div class="form-group">
            <label for="">配送费</label>
            <input type="text" name="send_cost" class="form-control" value="{{ $shopmanager->send_cost }}">
        </div>
        <div class="form-group">
            <label for="">店铺公告</label>
            <input type="text" name="notice" class="form-control" value="{{ $shopmanager->notice }}">
        </div>
        <div class="form-group">
            <label for="">优惠信息</label>
            <input type="text" name="discount" class="form-control" value="{{ $shopmanager->discount }}">
        </div>
        <label for="">店铺状态</label>
        <div class="radio">
            <label for="">
                <input type="radio" value="{{ $shopmanager->status }}" name="status" @if($shopmanager->status) checked="checked" @endif>正常
            </label>
            <label for="">
                <input type="radio" value="{{ $shopmanager->status }}" name="status" @if(!$shopmanager->status) checked="checked" @endif >待审核
            </label>
            <label for="">
                <input type="radio" value="{{ $shopmanager->status }}" name="status" @if($shopmanager->status == '-1') checked="checked" @endif>禁用
            </label>
        </div>
        {{ csrf_field() }}
        {{ method_field('PUT')}}
        <button class="btn btn-info">提交</button>
    </form>    
@endsection
