<?php
namespace App\Services;

use App\Models\Category;

class CategoryService {

    public function __construct(){

    }
    public function show(){
        return Category::select('id','name')->where('parent_id',0)->orderByDesc('id')->paginate(3);
    }
    public function getId($id){
        return Category::where('status',1)->find($id);
    }
    public function getProduct($category){
        return $category->products()
        ->select('id','name','price','price_sale','feature_image_path')
        ->where('status',1)
        ->orderByDesc('id')
        ->paginate(12);
    }

    
    
}