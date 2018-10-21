@extends('layout.default')
@section('contents')
    <h2>商家账状态审核</h2>
    <form action="{{ route('shops.verifystore',['id' => $shop->id]) }}" method="post">
        <div class="form-group">
            <label for="">商家账号</label>
            <input type="text" name="name" class="form-control" value="{{ $shop->shopuser['name'] }}" disabled="disabled">
        </div>
        <div class="form-group">
            <label for="">店铺名称</label>
            <input type="text" name="shop_name" class="form-control" value="{{ $shop['shop_name'] }}">
        </div>
        <label for="">商家信息状态</label>
        <div class="radio">
            <label for="">
                <input type="radio" name="status" value="1" @if($shop['status']) checked="checked" @endif>正常
            </label>
            <label for="">
                <input type="radio" name="status" value="0" @if(!$shop['status']) checked="checked" @endif>待审核
            </label>
            <label for="">
                <input type="radio" name="status" value="-1" @if(!$shop['status']==1) checked="checked" @endif>禁用
            </label>
        </div>
        {{ csrf_field() }}
        <button class="btn btn-info">提交审核</button>
    </form>
@endsection


