<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCheck extends Model
{
    use HasFactory;

    protected $table = 'paymentcheck';

    protected $fillable = [
        'orderdetail_id',
        'nama',
        'bankasal',
        'banktujuan',
        'image'
    ];

    public function OrderDetail(){
        return $this->belongsTo(OrderDetail::class,'orderdetail_id');
    }
}
