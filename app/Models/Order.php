<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;



class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'customer_id',
        'user_id',
        'gst',
        'amount',
        'cash',
        'card',
        'upi',
        'spl_discount',
        'redeem',
        'status',
        'order_status',
    ];    
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}