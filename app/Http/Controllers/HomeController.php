<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::latest()->take(4)->get();
        return view('home', compact('products'));

    }

    public function about()
    {
        $data = ['username' => 'John Doe'];
        return view('about', $data);
    }

    public function catalog(\Illuminate\Http\Request $request)
    {
        $categories = \App\Models\Category::all();

        $products = \App\Models\Product::query()->when($request->category, function($query, $category) {
            return $query->where('category_id', $category);
        })

        ->when($request->min_price, function($query, $min_price){
            return $query->where('price', $min_price);
        })
        
        ->when($request->max_price, function($query, $max_price){
            return $query->where('price', $max_price);
        })

        ->when($request->stock === 'in', function($query){
            return $query->where('stock', '>', 0);
        })
        ->when($request->stock === 'sale', function($query){
            return $query->where('discount','>',0);
        })
        ->get();

        return view('catalog', compact('categories','products'));
    }
}
