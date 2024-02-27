<?php

use Illuminate\Support\Str;



if(!function_exists('category')){
    function category($categories,$parent_id=0){
        $html = '';
        foreach($categories as $key=>$category){
            if($category->parent_id == $parent_id){
                $html .= '
                    <li>
                        <a href="/category/'. $category->id . '-' . Str::slug($category->name) .'.html">'
                        . $category->name   .'</a>';
                unset($categories[$key]);
                if($category->categoryChild->count()  == true){
                    $html .= '<ul class="sub-menu">';
                    $html .= category($categories, $category->id);
                    $html .= '</ul>';

                }
                $html.='</li>';
            }
        }
        return $html;
    }
}
if(!function_exists('menu')){
    function menu($menus,$parent_id=0){
        $html = '';
        foreach($menus as $key=>$menu){
            if($menu->parent_id == $parent_id){
                $html .= '
                    <li>
                        <a href="/menu/'. $menu->id . '-' . Str::slug($menu->name) .'.html">'
                        . $menu->name   .'</a>';
                unset($menus[$key]);
                if($menu->menuChild->count()){
                    $html .= '<ul class="sub-menu-m">';
                    $html .= menu($menu->menuChild, $menu->id);
                    $html .= '</ul>';

                }
                $html.='</li>';
            }
        }
        return $html;
    }
}
if (!function_exists('price')) {
    function price($price = 0, $price_sale = 0)
    {
        if ($price_sale != 0)
            return $price_sale;

        if ($price != 0)
            return $price;
        return 'Liên hệ';
    }
}