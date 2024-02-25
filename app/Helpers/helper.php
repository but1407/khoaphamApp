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