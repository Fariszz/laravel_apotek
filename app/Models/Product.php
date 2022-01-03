<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'kode_barang',
        'user_id',
        'category_id',
        'nama',
        'harga',
        'description',
        'stok',
        'image',
        'telfon',
        'diskon'
    ];

    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function OrderDetail(){
        return $this->hasMany(OrderDetail::class);
    }
}
