<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->take(3)->get();
        $categori = Category::all();
        $productsByCategory = [];

        foreach ($categori as $category) {
            $productsByCategory[$category->id] = Product::where('category_id', $category->id)->take(10)->get();
        }
        return view('Frontend.home.home',compact('categories','categori', 'productsByCategory'));
    } 
}
