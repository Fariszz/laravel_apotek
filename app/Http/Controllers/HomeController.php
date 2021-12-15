<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $auth = Auth::user();
        $products = Product::with('User')->paginate(5);
        $wishlists = Wishlist::all()->where('user_id',Auth::user()->id);
        return view('welcome',[
            'auth' => $auth,
            'products' => $products,
            'wishlists' => $wishlists
        ]);
    }

    public function show($id){
        $product = Product::where('id', $id)->first();
        $wishlists = Wishlist::all()->where('user_id',Auth::user()->id);
        return view('detail',[
            'product' => $product,
            'wishlists' => $wishlists
        ]);
    }

    public function search(Request $request){
        $keyword = $request->search;
        $products = Product::with('User')->where('nama', 'like', '%'. $keyword . '%')->paginate(6);
        $wishlists = Wishlist::all()->where('user_id',Auth::user()->id);
        return view('welcome', [
            'products' => $products,
            'wishlists' => $wishlists
        ]);
    }
}
