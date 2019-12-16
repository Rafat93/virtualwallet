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

    public function getIncomeTypes(Request $request){
        return CategoryResource::collection(Category::all()->where('type','i'));
    }
    public function getExpenseTypes(Request $request){
        return CategoryResource::collection(Category::all()->where('type','e'));
    }
}
