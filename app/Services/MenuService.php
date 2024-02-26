<?php
namespace App\Services;

use App\Models\Menu;

class MenuService {

    public function __construct(){

    }
    public function show(){
        return Menu::select('id','name')->where('parent_id',0)->Where('active',1)->orderByDesc('id')->get();
    }

    
    
}