<?php
namespace App\Services;

use App\Models\Cart;
use App\Jobs\SendMail;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function __construct(){

    }

    public function create($request)
    {
        $qty = (int)$request->input('num_product');
        $product_id = (int)$request->input('product_id');

        if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }

        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_id => $qty
            ]);
            return true;
        }

        $exists = Arr::exists($carts, $product_id);
        if ($exists) {
            $carts[$product_id] = $carts[$product_id] + $qty;
            Session::put('carts', $carts);
            return true;
        }

        $carts[$product_id] = $qty;
        Session::put('carts', $carts);

        return true;
    }

    public function getProduct()
    {
        $carts = Session::get('carts');
        if (is_null($carts)) return [];

        $productId = array_keys($carts);
        return Product::select('id', 'name', 'price', 'price_sale', 'feature_image_path')
            ->where('status', 1)
            ->whereIn('id', $productId)
            ->get();
    }

    public function update($request)
    {
        Session::put('carts', $request->input('num_product'));
        return true;
    }

    public function remove($id)
    {
        $carts = Session::get('carts');
        unset($carts[$id]);

        Session::put('carts', $carts);
        return true;
    }

    public function addCart($request){
        try{
            DB::beginTransaction();
            $carts = Session::get('carts'); 
            if(is_null($carts)) return false;
            $customer = Customer::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'content' => $request->content,

            ]);
            // dd($customer->products()->pluck('name')-);
            $this->infoProductCart($carts, $customer->id);
            DB::commit();
            Session::flash('success','Đặt hàng thành công');
            $products= $customer->products;
            $orders = [];
            foreach ($products as $product){
                $quatity = 0;
                foreach($customer->products()->select('qty')->where('product_id',$product->id)->get() as $qty){
                    $quatity = $qty->qty;
                }
                $orders[] =[
                    'name' =>$product->name,
                    'image' =>$product->feature_image_path,
                    'price'=>price($product->price,$product->price_sale),
                    'qty'=> $quatity,

                ]; 
                unset($quality);
            }
            #Queue 
            SendMail::dispatch($request->email,$orders)->delay(now()->addSecond(2));
            
            Session::forget('carts');
        } catch(\Exception $e){
            DB::rollBack();
            Session::flash('error', 'Đặt hàng lỗi, Vui lòng thử lại sau');
            return false;
        }
        return true;
    }

    protected function infoProductCart($carts,$customer_id){
        $productId = array_keys($carts);
        $products = Product::select('id', 'name', 'price', 'price_sale', 'feature_image_path')
            ->where('status', 1)
            ->whereIn('id', $productId)
            ->get();
        $data = [];
        foreach($products as $product){
            $data[] = [
                'customer_id' => $customer_id,
                'product_id' => $product->id,
                'qty' => $carts[$product->id],
                'price' => $product->price_sale != 0 ? $product->price_sale : $product->price,
            ];
        }
        return Cart::insert($data);
    }

}