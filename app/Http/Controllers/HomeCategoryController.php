<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeCategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(6);
        $wishlists = Wishlist::all()->where('user_id',Auth::user()->id);

        return view('category.index',[
            'categories' => $categories,
            'wishlists' => $wishlists
        ]);
    }

    public function show($slug){

        $category = Category::where('slug', $slug)->first();
        $products = Product::with('category')->where('category_id', $category->id)->paginate(6);
        $wishlists = Wishlist::all()->where('user_id',Auth::user()->id);
        return view('category.show',[
            'products' => $products,
            'wishlists' => $wishlists
        ]);
    }

}
