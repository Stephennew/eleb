<?php

namespace App\Http\Controllers;

use App\Model\EventMember;
use Illuminate\Http\Request;

class EventMemberController extends Controller
{
    public function index()
    {
        $eventmembers = EventMember::paginate(1);
        return view('eventmember.list',compact('eventmembers'));
    }
}
