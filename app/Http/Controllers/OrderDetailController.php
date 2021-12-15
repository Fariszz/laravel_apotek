<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\PaymentCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class OrderDetailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userHistory(){
        $users = OrderDetail::with('user')->where('user_id',Auth::user()->id)->paginate(10);

        return view('dashboard.user.history',[
            'users' => $users
        ]);
    }

    public function checkUserPayment(){
        $users = OrderDetail::with('user')->paginate(10);
        // dd($users);
        return view('dashboard.user.payment',[
            'users' => $users
        ]);
    }

    public function changeStatusPayment($id){
        $order = OrderDetail::with('user')->where('id',$id)->first();
        $order->status = 1;

        $order->save();
        return redirect()->route('payment.check')->with('success','Payment Berhasil dirubah');

    }


    public  function createUploadPembayaran($id){
        $orderdetail = OrderDetail::where('id',$id)->first();

        return view('dashboard.user.buktiPembayaran',[
            'orderdetail' => $orderdetail
        ]);
    }

    public function uploadPembayaran(Request $request){

        $validatedData = $request->validate([
            'orderdetail_id' => 'required',
            'nama' => 'required',
            'bankasal' => 'required',
            'banktujuan' => 'required'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images', 'public');
        }

        PaymentCheck::create($validatedData);

        return redirect()->route('payment.history')->with('success', 'Success Melakukan Pembayaran');
    }
}
