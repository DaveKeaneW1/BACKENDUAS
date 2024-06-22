<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_order',
        'customer_id',
        'tanggal_pemesanan',
        'tanggal_pengiriman',
        'alamat_pengiriman',
        'total',
        'jenis_pengiriman',
        'bukti_pembayaran',
        'status',
        'created_at',
        'updated_at'
    ];

    protected $table = 'orders';

     // Define relationship with OrderItems
     public function orderItems()
     {
         return $this->hasMany(OrderItem::class, 'order_id', 'id');
     }

     // Define relationship with Order
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    // Scope to filter orders by customer and status
    public function scopeCustomerWithStatus($query, $customer, $status)
    {
        return $query->where('customer_id', $customer)
                     ->where('status', $status);
    }

     // Function to get or create an order
     public static function getOrCreateOrder($customer)
     {
         $status = 0;
         
         // Check if order exists with given customer and status
         $order = Order::customerWithStatus($customer, $status)->first();
 
         if (!$order) {
             // Create a new order with status = 0
             $no_order = Str::random(8);

             $order = Order::create([
                 'no_order' => $no_order,
                 'customer_id' => $customer,
                 'status' => $status,
                 'jenis_pengiriman' => 1
             ]);
         }
 
         return $order;
     }
}
