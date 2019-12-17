<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Category as CategoryResource;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return CategoryResource::collection(Category::all());
    }

    public function getIncomeTypes(Request $request){
        return CategoryResource::collection(Category::where('type','i')->get());
    }
    public function getExpenseTypes(Request $request){
        return CategoryResource::collection(Category::where('type','e')->get());
    }
}
