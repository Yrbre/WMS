<?php

namespace App\Http\Controllers;

use App\Service\CategoryService;


class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $category = $this->categoryService->getAll();

        return view('category.index', compact('category'));
    }
}
