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
    public function getProduct($category,$request){
        $query =  $category->products()
        ->select('id','name','price','price_sale','feature_image_path')
        ->where('status',1);
        if($request->price == 'asc'){

            $query = $query->orderBy('price_sale',$request->price);
        } elseif($request->price == 'desc'){
            $query = $query->orderBy('price_sale',$request->price);

        } else{
            $query = $query->orderByDesc('id');
        }
        return $query->paginate(10)->withQueryString();
    } 

    
    
}