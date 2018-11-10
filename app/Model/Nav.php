<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Nav extends Model
{
    protected  $fillable = ['name','pid','permission_id','url'];

    public static function getNavs()
    {
        //获取所有的一级菜单
        $navs = self::where('pid', 0)->get();
        $html = '';
        $nav_html = '';
        foreach ($navs as $nav){
            $childred = Nav::where('pid',$nav->id)->get();
            $childred_html = '';
            foreach ($childred as $children_nav){
                if(Auth::user()->can($children_nav->url))
                    $childred_html .='<li><a href="'.$children_nav->url.'">'.$children_nav->name.'</a></li>';
            }
            if($childred_html){
                $html .= ' <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$nav->name.'<span class="caret"></span></a>
                    <ul class="dropdown-menu">';
                $html .= $childred_html;
                $html .='</ul></li>';
            }
        }
        $nav_html = $html;
        return $nav_html;
    }
}
