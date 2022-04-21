<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function all(Request $request){
        $id = $request->input('id');
        $limit = $request->input('limit');
        $nama = $request->input('nama');
        $harga = $request->input('harga');
        $description = $request->input('description');
        $stok = $request->input('stok');

        if ($id) {
            $product = Product::with(['category'])->find($id);

            if ($product) {
                return ResponseFormatter::success(
                    $product,
                    'Data produk berhasil diambil'
                );
            }
            else {
                return  ResponseFormatter::error(
                    null,
                    'Data produk tidak ada',
                    404
                );
            }
        }

        $product = Product::with(['category']);

        if ($nama) {
            $product->where('nama', 'like','%' . $nama . '%');
        }

        if ($harga) {
            $product->where('harga', 'like','%' . $harga . '%');
        }

        if ($description) {
            $product->where('description', 'like','%' . $description . '%');
        }

        if ($stok) {
            $product->where('stok', 'like','%' . $stok . '%');
        }

        return ResponseFormatter::success(
            $product->paginate($limit),
            'Data produk berhasil diambil'
        );



    }
}
