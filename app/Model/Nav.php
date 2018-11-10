<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Nav extends Model
{
    protected  $fillable = ['name','pid','permisssion_id','url'];

    public static function getNavs()
    {
        //获取所有的一级菜单
        $navs = self::where('pid', 0)->get();
        $html = '';
        foreach ($navs as $nav){
            $html .= ' <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$nav->name.'<span class="caret"></span></a>
                    <ul class="dropdown-menu">';
            $children_navs = self::where('pid',$nav->id)->get();
            foreach ($children_navs as $children_nav){
                //if(Auth::user()->can($children_nav->permission_id))
                    $html .='<li><a href="'.$children_nav->url.'">'.$children_nav->name.'</a></li>';
            }
            $html .='</ul></li>';
        }
        return $html;
    }
}
