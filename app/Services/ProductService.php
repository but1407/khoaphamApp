<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Category;

class ProductService {

    const LIMIT = 16;
    public function __construct(){
        
    }
    public function get($page=null){
        // dd($page);
        return Product::select('id', 'name', 'price', 'price_sale', 'feature_image_path')->where('status', 1)
            ->orderByDesc('id')
            ->when($page != null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
        })
        ->limit(self::LIMIT)->get();

    }
    public function show($id){
        return Product::where('status', 1)->with('categories')->find($id);
    }
    public function more($id){
        return Product::select('id', 'name', 'price', 'price_sale', 'feature_image_path')
        ->where('status', 1)
        ->where('id','!=', $id)
        ->orderByDesc('id')
        ->limit(8)
        ->get();
    }
    
    

    
    
}