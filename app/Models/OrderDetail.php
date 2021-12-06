<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'orderdetails';

    protected $fillable = [
        'order_id',
        'product_id',
        'qty'
    ];

    public function orders(){
        return $this->belongsTo(Orders::class);
    }

    public function Product(){
        return $this->belongsTo(Product::class);
    }
}
