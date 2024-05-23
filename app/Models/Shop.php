<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'add',
        'shop_name',
        'mobile_no',
        'email',
        'gst_no',
        'aadhar_no',
        'pan_no',
        'msme_no',
        'upi_id',
        'bank_name',
        'branch_name',
        'ifsc_code',
        'account_no',
        'account_holder_name',
        'account_type',
        'aadhar_front',
        'aadhar_back',
        'pan_card',
        'gst_certificate',
        'msme_certificate',
        'cancel_cheque',
        'photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
