<?php

namespace App\Http\Controllers\Main;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Services\SliderService;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Services\ProductService;

class MainController extends Controller
{
    private $category;
    private $slider;
    private $sliderService;
    private $menuService;
    private $productService;


    public function __construct(
    CategoryService $category,
    Slider $slider,
    SliderService $sliderService,
    MenuService $menuService,
    ProductService $productService
    ){
        $this->category = $category;
        $this->slider = $slider;
        $this->sliderService = $sliderService;
        $this->menuService = $menuService;
        $this->productService = $productService;
    }
    public function index(){
        // dd($this->menuService->show()->menuChild);
        // dd($this->productService->get());
        return view('main.main',[
            'title' => 'Home',
            'categories' => $this->category->show(),
            'menus'=>$this->menuService->show(),
            'sliders'=> $this->sliderService->show(),
            'products'=>$this->productService->get(),
            ]);
    } 

    public function loadProduct(Request $request){
        $page =$request->input('page',0);
        // dd($page);
        $result = $this->productService->get($page);
        if(count($result) != 0){
            $html = view('product.list',['products'=>$result])->render();
            return response()->json([
                'html' => $html
            ]);
        }
        return response()->json([
            'html' =>''
        ]);

    }
}