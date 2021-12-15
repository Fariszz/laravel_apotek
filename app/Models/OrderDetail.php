<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
// use KyslikColumnSortableSortable;


class OrderDetail extends Model
{
    use HasFactory, Sortable;

    protected $table = 'orderdetails';

    protected $fillable = [
        'user_id',
        'total',
        'status'
    ];

    public $soratble = ['total'];

    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }

}
