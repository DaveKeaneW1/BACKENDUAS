<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'jumlah',
        'harga'
    ];

    protected $table = 'order_items';

    // Define relationship with Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    // Define relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
