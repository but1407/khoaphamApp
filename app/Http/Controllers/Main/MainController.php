<?php

namespace App\Http\Controllers\Main;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CategoryService;



class MainController extends Controller
{
    private $category;
    public function __construct(CategoryService $category, ){
        $this->category = $category;
    }
    public function index(){
        return view('main.main',[
            'categories' => $this->category->show(),
        ]
        
    );
    } 
}