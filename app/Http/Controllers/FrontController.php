<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $types = Type::all();

        return view('index', compact('types'));
    }

    public function categories(Request $request)
    {
        $type = $request->type;

        $categories = Category::where('type_slug', $type)->get();

        return $categories;
    }

    public function products($slug)
    {
        // return $products = Product::where('group_slug', $slug)->get();
        $products = Product::where('group_slug', $slug)->paginate(16);

        return view('products', compact('products', 'slug'));
    }


}
