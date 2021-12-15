<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlist';

    protected $fillable = [
        'user_id',
        'category_id',
        'product_id',
        'nama',
        'harga',
        'description',
        'quantity',
        'image',
    ];

    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function Product(){
        return $this->belongsTo(Product::class,  'product_id');
    }
}
