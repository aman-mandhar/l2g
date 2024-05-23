<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'prod_pic',
        'type',
        'gst', 
        'category_id',
        'subcategory_id',
        'variation_id',
        'token_id',
        'gallery_link',
        'created_by'
        ];

        public function inventory()
        {
            return $this->hasMany(Inventory::class);
        }
    
        public function categories()
        {
            return $this->hasMany(ProductCategory::class);
        }
    
        public function subcategories()
        {
            return $this->hasMany(ProductSubcategory::class);
        }
    
        public function variations()
        {
            return $this->hasMany(ProductVariation::class);
        }
    
        public function category()
        {
            return $this->belongsTo(ProductCategory::class, 'category_id');
        }
    
        public function subcategory()
        {
            return $this->belongsTo(ProductSubcategory::class, 'subcategory_id');
        }
    
        public function variation()
        {
            return $this->belongsTo(ProductVariation::class, 'variation_id');
        }
    
        public function tokens()
        {
            return $this->belongsTo(Token::class, 'token_id');
        }

        public function createdBy()
        {
            return $this->belongsTo(User::class, 'created_by');
        }

        

}

