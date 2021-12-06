<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order($id){
        $product = Product::where('id',$id)->first();

        Product::where('id',$id)->decrement('stok',1);

        /*DB::transaction(function () use($product,$id) {
            $orderdetail = new OrderDetail;
            $orderdetail->product_id = $product->id;
            $orderdetail->user_id = Auth::user()->id;
            Product::where('id',$id)->decrement('stok',1);
            $orderdetail->qty->increment();
        }); */

        DB::beginTransaction();
            try{
                $orderdetail = new OrderDetail;
                $orderdetail->product_id = $product->id;
                $orderdetail->user_id = Auth::user()->id;
                Product::where('id',$id)->decrement('stok',1);
                $orderdetail->qty->increment();
                DB::commit();
            }catch(Exception $e){
                // Rollback Transaction
                DB::rollBack();
                // ada yang error
            }
        }
}
