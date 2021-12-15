<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Wishlist;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        // $wishlists = Wishlist::where('user_id',Auth::user()->id);
        $wishlists = Wishlist::all()->where('user_id',Auth::user()->id);

        // dd($wishlists);
        return view('cart',compact('wishlists'));
    }

    public function addToWishlist(Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'category_id' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'quantity' => 'required',
            'product_id' =>  'required'
        ]);

        $validatedData['user_id'] = Auth::user()->id;

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        $product_id = $request->get('product_id');
        $product = Product::where('id',$product_id)->first();
        // dd($product);
        $product->stok = $product->stok - 1;
        $product->save();
        Wishlist::create($validatedData);

        return redirect()->route('cart.index')->with('success','Product berhaisl ditambahkan');
    }

    public function updateQuantity(Request $request,$id){
        // dd($request);
        $request->validate([
            'quantity' => 'required'
        ]);

        $wishlist = Wishlist::with('Product')->where('id',$id)->first();
        $product = Product::where('id',$wishlist->product_id)->first();
        $hargaAsli = $wishlist->product->harga;

        $quantity = $request->get('quantity');

        //* Apabila kuantitas yang lama lebih banyak dari pada kuantitas baru,maka akan menambah pada stok product
        if ($wishlist->quantity > $quantity) {
            $selsihStok = $wishlist->quantity - $quantity;
            $wishlist->quantity = $request->get('quantity');
            $product->stok = $product->stok + $selsihStok;
            $wishlist->harga = $hargaAsli * $quantity;

        //* Apabila kuantitas yang lama sama dengan kuantitas baru,maka tidak akan melakukan penambahan dan pengurangan
        }elseif ($wishlist->quantity == $quantity) {

            $wishlist->quantity = $request->get('quantity');
            $wishlist->harga = $hargaAsli * $quantity;

        //* Apabila kuantitas yang lama lebih sedikit dari pada kuantitas baru,maka akan mengurangi pada stok product
        }elseif($wishlist->quantity < $quantity ){
            $selsihStok = $quantity - $wishlist->quantity;
            $wishlist->quantity = $request->get('quantity');
            $product->stok = $product->stok - $selsihStok;
            $wishlist->harga = $hargaAsli * $quantity;

        }

        $wishlist->save();
        $product->save();

        return redirect()->route('cart.index')->with('success','Product Updated');
    }

    public function destroy($id){
        $wishlist = Wishlist::where('id',$id)->first();


        //* Stok
        DB::beginTransaction();

        try {
            $wishlistProduct = Wishlist::with('Product')->where('id',$id)->first();
            $product = Product::where('id',$wishlistProduct->product_id)->first();

            $product->stok = $product->stok + $wishlistProduct->quantity;

            $product->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }


        Wishlist::find($wishlist->id)->delete();
        return redirect()->route('cart.index')->with('success','Product Removed');
    }

    public function addToOrder(){
        DB::beginTransaction();
        try{
            $sumTotal = Wishlist::where('user_id', Auth::user()->id)->sum('harga');

            $orderdetails = new OrderDetail;
            $orderdetails->user_id = Auth::user()->id;
            $orderdetails->total = $sumTotal;

            $orderdetails->save();

            Wishlist::where('user_id', Auth::user()->id)->delete();

            DB::commit();

        }catch(Exception $e){
            DB::rollBack();
            // dd($e);
        }

        // dd($total);

        return redirect()->route('cart.index')->with('success','Checkout Berhasil');
    }
}
