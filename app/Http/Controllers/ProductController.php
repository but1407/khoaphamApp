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
    public function index($id, $slug){
        $product = $this->productService->show($id);
        $productMore = $this->productService->more($id);
        return view('product.content',[
            'title'=> $product->name,
            'product'=>$product,
            'menus'=>$this->menuService->show(),
            'products'=>$productMore,
        ]);
    }
}
