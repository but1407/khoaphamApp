<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function __construct(){

    }

    public function create($request){
        $qty = (int)$request->num_product;
        $product_id = (int) $request->product_id;

        if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc sản phẩm bạn chọn không chính xác');
        }


        $carts = Session::get('carts');
        if(is_null($carts)){
            Session::put('carts', [
                $product_id => $qty
            ]);
            return true;
        }
        $exists = Arr::exists($carts, $product_id);
        if($exists){
            $carts[$product_id] +=  $qty;
            Session::put('carts', [
                $product_id => $carts[$product_id]
            ]);
        }
        Session::put('carts', [
            $product_id => $qty
        ]);
        return true;
        
    }
    public function get(){
        $carts = Session::get('carts');
        if (is_null($carts))
            return [];

        $productId = array_keys($carts);
        return Product::select('id','name','feature_image_path','price','price_sale')
        ->where('status',1)
        ->whereIn('id',$productId)
        ->get();
    }

}