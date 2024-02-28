<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
use App\Services\MenuService;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $cartService;
    private $menuService;

    public function __construct(CartService $cartService,MenuService $menuService ){
        $this->cartService =$cartService;
        $this->menuService = $menuService;

    }
    public function index(Request $request){
        $result = $this->cartService->create($request);
        if(!$result){
            return redirect()->back();
        }
        return redirect('/carts');
    }
    public function show(){
        $products = $this->cartService->getProduct();
        return view('carts.list',[
            'title' => 'Giỏ hàng',
            'products' => $products,
            'menus'=>$this->menuService->show(),
            'carts' => Session::get('carts'),

        ]);
    }
    public function update(Request $request){
        $this->cartService->update($request);
        return redirect('/carts');
        
    }
    public function remove($id){
        $this->cartService->remove($id);
        return redirect('/carts');

    }
    public function addCart(Request $request){
        dd($request->input());
    }
}
