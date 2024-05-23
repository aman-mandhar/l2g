<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Import the User model

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [ // Mass assignable attributes
        'user_id',
        'ref_id',
        'add',
        'city',
        'employee_name',
        'mobile_no',
        'email',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ref()
    {
        return $this->belongsTo(User::class, 'ref_id');
    }
}

