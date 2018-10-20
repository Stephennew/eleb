<?php

namespace App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Admin extends Authenticatable
{
    protected $fillable = [
      'name','password','email','remember_token'
    ];
}
