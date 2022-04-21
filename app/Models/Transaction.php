<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'user_id', 'quantity', 'total', 'status', 'payment_url'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id', 'product_id');
    }

    public  function user()
    {
        return $this->belongsTo(User::class,'id', 'user_id');
    }
}
