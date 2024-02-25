<?php
namespace App\Services;

use App\Models\Category;

class CategoryService {

    public function __construct(){

    }
    public function show(){
        return Category::select('id','name')->where('parent_id',0)->orderByDesc('id')->paginate(3);
    }

    
    
}