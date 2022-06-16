<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function all(Request $request){
        $nama = $request->input('nama');
        $harga = $request->input('harga');
        $limit= $request->input('limit');
        $quantity = $request->input('quantity');

        $wishlist = Wishlist::with(['product', 'user', 'category'])->where('user_id', Auth::user()->id);

        return ResponseFormatter::success(
            $wishlist->paginate($limit),
            'Data list transaksi berhasil diambil'
        );
    }

    public function addToCart(Request $request){
        $validatedData = $request->validate([
            'category_id' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'quantity' => 'required',
            'product_id' =>  'required'
        ]);

        $validatedData['user_id'] = Auth::user()->id;

        $product_id = $request->get('product_id');
        $product = Product::where('id',$product_id)->first();
        // dd($product);
        $product->stok = $product->stok - 1;
        $product->save();
        Wishlist::create($validatedData);
        return ResponseFormatter::success('', 'product berhasil ditambahkan');
    }

    public function delete($id){
        $wishlist = Wishlist::where('id',$id)->first();

        $wishlistProduct = Wishlist::with('Product')->where('id',$id)->first();
        $product = Product::where('id',$wishlistProduct->product_id)->first();

        $product->stok = $product->stok + $wishlistProduct->quantity;

        $product->save();

        Wishlist::find($wishlist->id)->delete();

        return ResponseFormatter::success('', 'Produk berhasil dihapus');
    }
}
