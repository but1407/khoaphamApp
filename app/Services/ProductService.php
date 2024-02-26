<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Category;

class ProductService {

    const LIMIT = 16;
    public function __construct(){
        
    }
    public function get($page=null){
        return Product::select('id', 'name', 'price', 'price_sale', 'feature_image_path')->where('status', 1)
            ->orderByDesc('id')
            ->when($page !== null, function ($query) use ($page) {
                $query->offset($page * self::LIMIT);
        })
        ->limit(self::LIMIT)->get();

    }
    

    
    
}