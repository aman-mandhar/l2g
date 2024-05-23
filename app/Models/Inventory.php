<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'qty',
        'mrp',
        'sale_price',
        'discount',
        'vendor_tokens',
        'vendor_ref_tokens',
        'customer_tokens',
        'ref_tokens',
        'batch_no',
        'mfg_date',
        'exp_date',
        'remarks',
        'qr_code',
        'user_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
