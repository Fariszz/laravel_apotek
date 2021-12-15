<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    Use Sluggable;

    protected $table = 'category';

    protected $fillable = [
        'nama',
        'slug'
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function sluggable(): array
    {
        return[
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }

}
