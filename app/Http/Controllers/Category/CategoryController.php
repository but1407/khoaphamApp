<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{
    private $categoryService;
    private $menuService;

    public function __construct(CategoryService $categoryService,
    MenuService $menuService,
    ){
        $this->categoryService = $categoryService;
        $this->menuService = $menuService;


    }
    public function index(Request $request, $id, $slug)
    {
        
        $category= $this->categoryService->getId($id);
        $products= $this->categoryService->getProduct($category,$request);
        return view('category',[
            'title' => $category->name,
            'products' => $products,
            'category' => $category,
            'menus'=>$this->menuService->show(),

        ]);

    }
}
