<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentCheck;

class PaymentController extends Controller
{
    public function show($id){
        $paymentcheck = PaymentCheck::where('orderdetail_id', $id)->paginate(6);
        // dd($paymentcheck);
        return view('dashboard.user.UserCheckPayment',[
            'paymentcheck' => $paymentcheck
        ]);
    }
}
