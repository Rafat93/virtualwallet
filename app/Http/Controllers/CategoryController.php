<?php

namespace App\Http\Controllers;


use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return CategoryResource::collection(Category::all());
    }

    public function getIncomeTypes(){
        return CategoryResource::collection(Category::where('type','i'));
    }
    public function getExpenseTypes(){
        return CategoryResource::collection(Category::where('type','e'));
    }
}
