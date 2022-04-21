<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function all(Request $request){
        $id = $request->input('id');
        $nama = $request->input('nama');
        $slug = $request->input('slug');

        if ($slug) {
            $category_id = Category::where('slug', $slug)->first();
            $product = Product::with(['category'])->where('category_id', $category_id->id)->paginate(6);

            if ($product) {
                return ResponseFormatter::success(
                    $product,
                    'Data kategori berhasil diambil'
                );
            }
            else {
                return  ResponseFormatter::error(
                    null,
                    'Data kategori tidak ada',
                    404
                );
            }
        }

        $category = Category::all();

        if ($nama) {
            $category->where('nama', 'like','%' . $nama . '%');
        }

        if ($slug) {
            $category->where('slug', 'like','%' . $slug . '%');
        }

        return ResponseFormatter::success(
            $category,
            'Data kategori berhasil diambil'
        );

    }
}
