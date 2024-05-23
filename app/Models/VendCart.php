<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
            'order_id',
        'user_id',
        'inventory_id',
        'product_name',
        'quantity',
        'weight',
        'price',
        'total',
        'total_gst',
        'discount',
        'customer_tokens',
        'ref_tokens',
        'vendor_tokens',
        'vendor_ref_tokens',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }
    
}
