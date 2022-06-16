<?php

namespace App\Http\Controllers\API;

use Midtrans\Config;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\TransactionItem;
use Exception;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;

class TransactionController extends Controller
{
    public function all(Request $request){
        $id =   $request->input('id');
        $limit = $request->input('limit', 6);
        $product_id = $request->input('product_id');
        $status = $request->input('status');

        if ($id) {
            $transaction = Transaction::with(['product', 'user'])->find($id);

            if ($transaction) {
                return ResponseFormatter::success([
                    $transaction,
                    'Data transaksi berhasil diambil'
                ]);
            }
            else{
                return ResponseFormatter::error(
                    null,
                    'Data transaksi tidak ada',
                    404
                );
            }
        }

        $transaction = Transaction::with(['product', 'user'])->where('user_id', Auth::user()->id);

        if($product_id)
        $transaction->where('product_id', $product_id);

        if($status)
            $transaction->where('status', $status);

        return ResponseFormatter::success(
            $transaction->paginate($limit),
            'Data list transaksi berhasil diambil'
        );
    }

    public function update(Request $request, $id){
        $transaction = Transaction::findOrFail($id);

        $transaction->update($request->all());

        return ResponseFormatter::success($transaction, 'Transaksi berhasil diperbarui');
    }

    public function checkout(Request $request){
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:product,id',
            'total_price' => 'required|numeric',
            'status' => 'required|in:PENDING,SUCCESS,CANCELLED,FAILED,SHIPPING,SHIPPED',
        ]);

        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'total_price' => $request->total_price,
            'status' => $request->status,
            'payment_url' => ''
        ]);

        foreach ($request->items as $product) {
            // dd($product['id']);
            TransactionItem::create([
                'users_id' => Auth::user()->id,
                'products_id' => $product['id'],
                'transactions_id' => $transaction->id,
                'quantity' => $product['quantity']
            ]);
        }

          // konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        // Panggil transaksi yang tadi dibuat
        $transaction = Transaction::with(['user','items'])->find($transaction->id);

        // membuat transaksi midtrans
            $midtrans = [
                'transaction_details' => [
                    'order_id' => $transaction->id,
                    'gross_amount' => (int)$transaction->total_price
                ],
                'customer_details' => [
                    'first_name' => $transaction->user->name,
                    'email' => $transaction->user->email,
                ],
                'enabled_payments' => ['gopay','bank_transfers'],
                'vtweb' => []
        ];

        try {
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
            $transaction->payment_url = $paymentUrl;
            // dd($paymentUrl);
            $transaction->save();

            return ResponseFormatter::success($transaction, 'Transaksi berhasil dibuat');
        } catch (Exception $e) {
            return ResponseFormatter::success($e->getMessage(), 'Transaksi gagal dibuat');
        }

        // return ResponseFormatter::success($transaction->load('items.product'), 'Transaksi berhasil');
    }
}
