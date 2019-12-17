<?php

namespace App\Http\Controllers\Api;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Controllers\Controller;

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
