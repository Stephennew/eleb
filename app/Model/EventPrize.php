<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EventPrize extends Model
{
    protected $fillable = [
        'events_id','name','description','member_id'
    ];

    public function prizes()
    {
        return $this->belongsTo(Events::class,'events_id','id');
    }
}
