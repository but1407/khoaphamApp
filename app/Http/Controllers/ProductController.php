<?php

namespace App\Http\Controllers;

use App\Services\MenuService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;
    private $menuService;
    public function __construct(ProductService $productService,
    MenuService $menuService
    ){
        $this->productService = $productService;
        $this->menuService = $menuService;
    }
    public function index(Request $request, $id, $slug){
        // dd(2);
        $product = $this->productService->show($id);
        return view('product.content',[
            'title'=> $product->name,
            'product'=>$product,
            'menus'=>$this->menuService->show(),
        ]);
    }
}
