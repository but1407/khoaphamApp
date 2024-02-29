<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];

    // public function carts(){
    //     return $this->belongsToMany(Product::class,);
    // }
    public function products(){
        return $this->belongsToMany(Product::class,'carts', 'customer_id', 'product_id');
    }
}
