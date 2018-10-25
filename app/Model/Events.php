<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = [
        'title', 'content', 'signup_start', 'signup_end', 'prize_date', 'signup_num', 'is_prize'
    ];
}
