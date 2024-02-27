<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    private $categoryService;
    public function __construct(CategoryService $categoryService){
        $this->categoryService = $categoryService;

    }
    public function index(Request $request, $id, $slug)
    {
        $category= $this->categoryService->getId($id);
        $product= $this->categoryService->getProduct($category);

        dd($product);
    }
}
