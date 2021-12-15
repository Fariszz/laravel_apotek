<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'total',
        'status'
    ];

    public function orderdetails(){
        return $this->hasMany(Wishlist::class);
    }

    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
}
