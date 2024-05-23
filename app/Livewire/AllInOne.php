<?php

namespace App\Livewire;

use APP\Models\Inventory;
use APP\Models\Product;
use APP\Models\ProductCategory;
use APP\Models\ProductSubcategory;
use APP\Models\ProductVariation;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Order;
use App\Models\VendCart;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AllInOne extends Component
{

    public $products;
    public $vendor;
    public $today_amount;
    public $today_orders;
    public $today_cash;
    public $today_card;
    public $today_upi;
    public $today;
    public $todays;
    public $allProducts;
    public $total_orders;
    public $total_amount;
    public $total_cash;
    public $total_card;
    public $total_upi;
    public $qtys;
    public $weights;
    public $stocks;
    public $orders;
    
    

    public function mount()
    {
        // Fetch all products

        $this->products = DB::table('products')
        ->select(
            'products.*',
            'product_categories.name as category_name',
            'product_subcategories.name as subcategory_name',
            'product_variations.color as colour',
            'product_variations.size as size',
            'product_variations.weight as weight',
            'product_variations.length as length',
            'product_variations.liquid_volume as liquid',
            )
        ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
        ->leftJoin('product_variations', 'products.variation_id', '=', 'product_variations.id')->get();

        // 
            
        
        // Fetch all stock

        $this->stocks = DB::table('inventories')
        ->select(
            'inventories.*',
            'inventories.qty as qty',
            'inventories.weight as weight',
            'inventories.sale_price as price',
            'products.name as product_name',
            'products.gst as gst_rate',
            'products.type as type',
            'product_categories.name as category_name',
            'product_subcategories.name as subcategory_name',
            'product_variations.color as colour',
            'product_variations.size as size',
            'product_variations.weight as weight',
            'product_variations.length as length',
            'product_variations.liquid_volume as liquid',
            )
        ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
        ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
        ->leftJoin('product_variations', 'products.variation_id', '=', 'product_variations.id')->get();

        // Fetch all pending orders
       
        $this->orders = DB::table('orders')
        ->select('orders.*',)
        ->where('user_id', Auth::user()->id)
        ->where('status', 'pending')->get();

        $this->today_orders = $this->orders->count();
        $this->today_amount = $this->orders->sum('amount');
        $this->today_cash = $this->orders->sum('cash');
        $this->today_card = $this->orders->sum('card');
        $this->today_upi = $this->orders->sum('upi');

        // Fetch all orders

        $this->allProducts = DB::table('orders')
        ->select('orders.*',)
        ->where('user_id', Auth::user()->id)->get();

        $this->total_orders = $this->allProducts->count();
        $this->total_amount = $this->allProducts->sum('amount');
        $this->total_cash = $this->allProducts->sum('cash');
        $this->total_card = $this->allProducts->sum('card');
        $this->total_upi = $this->allProducts->sum('upi');
            
    }
    
    public function render()
    {
        return view('livewire.all-in-one');
    }
}
