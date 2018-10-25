<?php

namespace App\Http\Controllers;

use function foo\func;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SmailController extends Controller
{
    static public function sendMail($xiao,$email)
    {
        Mail::raw('恭喜您中奖了',function ($msg) use ($xiao,$email){
            $msg->subject($xiao);
            $msg->to($email);
        });
    }
}
