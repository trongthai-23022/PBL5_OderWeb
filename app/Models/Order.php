<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details','order_id','product_id');
    }
}
