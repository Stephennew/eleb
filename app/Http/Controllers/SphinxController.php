<?php

namespace App\Http\Controllers;

use App\SphinxClient;
use Illuminate\Http\Request;

class SphinxController extends Controller
{
    public function sphinx()
    {
        // --------------------------------------------------------------------------
// File name   : test_coreseek.php
// Description : coreseek中文全文检索系统测试程序
// Requirement : PHP5 (http://www.php.net)
//
// Copyright(C), HonestQiao, 2011, All Rights Reserved.
//
// Author: HonestQiao (honestqiao@gmail.com)
//
// 最新使用文档，请查看：http://www.coreseek.cn/products/products-install/
//
// --------------------------------------------------------------------------

        $cl = new SphinxClient();
        $cl->SetServer ( '127.0.0.1', 9312);
        //$cl->SetServer ( '10.6.0.6', 9312);
        //$cl->SetServer ( '10.6.0.22', 9312);
        //$cl->SetServer ( '10.8.8.2', 9312);
        $cl->SetConnectTimeout ( 10 );
        $cl->SetArrayResult ( true );
        // $cl->SetMatchMode ( SPH_MATCH_ANY);
        $cl->SetMatchMode ( SPH_MATCH_EXTENDED2);
        $cl->SetLimits(0, 1000);
        $info = '好吃面';
        $res = $cl->Query($info, 'test');//shopstore_search
        //print_r($cl);
        dd($res);
    }

    public function nihao()
    {
        echo 'hello';
    }
}
