<?php

namespace App\Http\Controllers\Main;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;



class MainController extends Controller
{
    private $category;
    private $slider;

    public function __construct(CategoryService $category,Slider $slider){
        $this->category = $category;
    }
    public function index(){
        return view('main.main',[
            'categories' => $this->category->show(),
            'sliders'=> $this->slider->show(),
            ]);
    } 
}