<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $cartService;

    public function __construct(CartService $cartService ){
        $this->cartService =$cartService;
    }
    public function index(Request $request){
        $result = $this->cartService->create($request);
        if(!$result){
            return redirect()->back();
        }
        return redirect('/carts');
    }
    public function show(){
        $products = $this->cartService->get();
        return view('carts.list',[
            'title' => 'Giỏ hàng'
        ]);
    }
}
