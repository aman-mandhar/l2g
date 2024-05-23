<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Product;
use App\Models\VendCart;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\User;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;



class VendorCheckout extends Component
{
    public $customer;
    public $prods;
    public $vendor_user_id;
    public $vendor;
    public $vendor_name;
    public $vendor_address;
    public $vendor_email;
    public $vendor_mob;
    public $vendor_gst;
    public $vendor_ref;
    public $carts;
    public $order;
    public $total_amount;
    public $total_discount;
    public $paying;
    public $balance;
    public $amt_payable;
    public $cash;
    public $card;
    public $upi;
    public $customer_name;
    public $customer_mob;
    public $net_gst;
    public $amount_without_discount;
    public $amount_with_discount;
    public $gst_with_discount;
    public $gst_without_discount;
    public $total_gst;

    public function mount()
    {
        // Fetch Session data
        $this->customer = session()->get('customer');
        $this->prods = session()->get('prods');
        
        // Fetch Vendor data
        $this->vendor_user_id = Auth::user()->id;
        $this->vendor = Vendor::where('user_id', $this->vendor_user_id)->first();
        
        // Fetch Cart Items with product & inventory details
        $productQuery = DB::table('vend_carts')
        ->select(
            'vend_carts.*',
            'products.name as product_name',
            'products.gst as gst_rate',
            'product_categories.name as category_name',
            'product_subcategories.name as subcategory_name',
            'product_variations.color as colour',
            'product_variations.size as size',
            'product_variations.weight as weight',
            'product_variations.length as length',
            'product_variations.liquid_volume as liquid',
            DB::raw('(vend_carts.total - vend_carts.discount) as total_with_discount'),
            )
        ->leftJoin('inventories', 'vend_carts.inventory_id', '=', 'inventories.id')
        ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
        ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
        ->leftJoin('product_variations', 'products.variation_id', '=', 'product_variations.id')
        ->where('vend_carts.customer_id', $this->customer->id)
        ->where('vend_carts.user_id', Auth::user()->id)
        ->whereNull('vend_carts.order_id')
        ->whereNull('vend_carts.deleted_at')
        ->get();
    
        $this->carts = $productQuery;

        
        // Calculate Grand Total
        $this->total_amount = $this->carts->sum('total');

        $this->total_discount = $this->carts->sum('discount');

        $this->total_gst = $this->carts->sum('total_gst');
        
        // Update paying and balance properties
        $this->paying = ($this->cash + $this->card + $this->upi);
        $this->balance = ($this->total_amount - $this->paying);    

        // Calculate amt_payable
        $this->calculateAmtPayable();
    }

    private function calculateAmtPayable()
    {
    
        $this->amt_payable = $this->total_amount - ($this->cash + $this->card + $this->upi);
        
        // Ensure amt_payable is not negative
        if ($this->amt_payable < 0) {
            $this->amt_payable = 0;
        }
       
    }
        
    public function updated($propertyName)
    {
        // Call calculateAmtPayable() whenever any payment-related property changes
        if (in_array($propertyName, ['cash', 'card', 'upi'])) {
            $this->calculateAmtPayable();
        }
        $this->validateOnly($propertyName, [
            'cash' => 'nullable|numeric|min:1',
            'card' => 'nullable|numeric|min:0.01',
            'upi' => 'nullable|numeric|min:0.01',
            
        ]);
    }
    
    public function savePayment()
    {
    
    // Validate payment data
    $this->validate([
        'cash' => 'nullable|numeric|min:1',
        'card' => 'nullable|numeric|min:0.01',
        'upi' => 'nullable|numeric|min:0.01',
        
    ]);
    
        $this->customer_name = $this->customer->name;
        $this->customer_mob = $this->customer->mobile_number;
        
    // Create a new order instance
    if ($this->amt_payable > 0) {
        return redirect()->back()->with('error', 'Please pay the full amount');
    }
    
    $order = new Order();
    $order->customer_id = $this->customer->id;
    $order->user_id = Auth::user()->id;
    $order->amount = $this->total_amount;
    $order->cash = $this->cash;
    $order->card = $this->card;
    $order->upi = $this->upi;
    $order->spl_discount = $this->total_discount;
    $order->gst = $this->total_gst;
    $order->status = 'pending';
    $order->save();

    // Update Vendor cart items with order_id
    VendCart::where('user_id', auth()->id())
        ->where('customer_id', $this->customer->id)
        ->where('order_id', null)
        ->update(['order_id' => $order->id]);

    // Clear session data
    session()->forget('customer');
    session()->forget('ref');
    session()->forget('prods');
    
    // Redirect to order details page
    return redirect()->route('vendor_orders.show', $order->id);

    }

    public function render()
    {
        return view('livewire.vendor-checkout');
    }
}
