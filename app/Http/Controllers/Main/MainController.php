<?php

namespace App\Http\Controllers\Main;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Services\SliderService;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;



class MainController extends Controller
{
    private $category;
    private $slider;
    private $sliderService;
    private $menuService;


    public function __construct(CategoryService $category,Slider $slider,SliderService $sliderService,MenuService $menuService){
        $this->category = $category;
        $this->slider = $slider;
        $this->sliderService = $sliderService;
        $this->menuService = $menuService;



    }
    public function index(){
        // dd($this->menuService->show()->menuChild);
        return view('main.main',[
            'title' => 'Home',
            'categories' => $this->category->show(),
            'menus'=>$this->menuService->show(),
            'sliders'=> $this->sliderService->show(),
            ]);
    } 
}