<?php

namespace App\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


class Admin extends Authenticatable
{
    //Traits  特性里面定义的属性和方法  use HasRoles 使用该特性，使用该特性里面的属性和方法
    //为了解决php 的单继承问题
    use HasRoles;
    protected $fillable = [
      'name','password','email','remember_token'
    ];
}
