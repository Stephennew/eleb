<?php

namespace App\Model;

use App\Http\Controllers\ShopCategoriesController;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'shop_category_id',
        'shop_name',
        'shop_img',
        'shop_rating',
        'brand',
        'on_time',
        'fengniao',
        'bao',
        'piao',
        'zhun',
        'start_send',
        'send_cost',
        'notice',
        'discount',
        'status',
    ];

    //一个商家 只能有一个分类
    public function shopcate()
    {
        return $this->belongsTo(ShopCategory::class,'shop_category_id','id');
    }

    //一个商家，对应一个用户信息
    public function shopuser()
    {
        return $this->hasOne(User::class);
    }
}
