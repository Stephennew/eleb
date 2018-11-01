<?php

namespace App\Http\Controllers;

use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function orders()
    {
        $end_day = date('Y-m-d H:i:s',time());
        $start_day= date('Y-m-d 00:00:00',strtotime('-7 day'));
        $orders = DB::select("select DATE_FORMAT(created_at,'%Y-%m-%d') as riqi,count(*) num 
            from orders 
            where created_at >= ? and created_at <= ? 
            GROUP BY riqi",[$start_day,$end_day]);


        $end_month = date('Y-m-d H:i:s',time());
        $start_month = date('Y-m-d 00:00:00',strtotime('-2 month'));
        $month_orders = DB::select("select DATE_FORMAT(created_at,'%Y-%m') as yuefen,count(*) as shuliang 
            from orders 
            where created_at >=? and created_at <= ? 
            GROUP  BY yuefen",[$start_month,$end_month]);
        return view( 'index.list',compact('orders'));
    }

    public function shops()
    {
        $start_day = date('Y-m-d 00:00:00',strtotime('-7 day'));
        $end_day = date('Y-m-d H:i:s',time());
        DB::enableQueryLog();
        $shops_amount = $shops_day_amoutn = DB::select("select shop_id,shop_name,SUM(amount) as num,date(orders.created_at) as riqi
            from order_details
            JOIN orders on order_details.order_id = orders.id
            JOIN shops on orders.shop_id = shops.id
            where orders.created_at >= ? and orders.created_at <= ?
            GROUP  BY shop_id,amount,orders.created_at,shop_name",[$start_day,$end_day]);


        $start_month = date('Y-m-d 00:00:00',strtotime('-2 month'));
        $end_month = date('Y-m-d H:i:s',time());
        $shops_month_amount = DB::select("select shop_id,shop_name,date(orders.created_at) riqi,SUM(amount) as num
            from order_details
            JOIN orders on order_details.order_id = orders.id
            JOIN shops on orders.shop_id = shops.id
            where orders.created_at >= ? and orders.created_at <= ?
            GROUP  BY shop_id,shop_name,orders.created_at,amount",[$start_month,$end_month]);
        var_dump(DB::getQueryLog());
        var_dump($shops_month_amount);

    }
}
