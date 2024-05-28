<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\ProductVariation;
use App\Models\User;
use App\Models\Order;
use App\Models\VendCart;
use App\Models\Vendor;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BarcodeScanner extends Component
{
    public $search;
    public $inventory_id;
        
    public $barcode;
    public $quantity;
    public $weight;
    public $inventory;
    public $errorMessage;
    public $successMessage;

    public $customer;
    public $mobile_number;
    public $users;
    public $prods;

    protected $updatesQueryString = [
        'barcode' => ['except' => '']
    ];

    public function mount()
    {
        if ($this->barcode) {
            $this->fetchInventory($this->barcode);
        }
        
        $this->customer = session()->get('customer');
        $this->prods = session()->get('prods');
    }

    public function updatedBarcode($value)
    {
        $this->fetchInventory($value);
    }

    public function fetchInventory($barcode)
    {
        $this->inventory = $this->prods->where('qr_code', $barcode)->first();

        if (!$this->inventory) {
            $this->errorMessage = 'Product not found.';
            $this->inventory = null;
            $this->successMessage = null;
        } else {
            $this->errorMessage = null;
            $this->successMessage = 'Product found!';
        }
    }

    public function addToCart()
    {
        // Check if user is logged in
        $user = Auth::user();
        if (!$user) {
            $this->errorMessage = 'User must be logged in.';
            return;
        }

        // Check if product is selected
        if (!$this->inventory) {
            $this->errorMessage = 'No product selected.';
            return;
        }

        // Check if customer is selected
        if (!$this->customer) {
            $this->errorMessage = 'No customer selected.';
            return;
        }

        // Validate quantity or weight
        $this->validate([
            'quantity' => 'nullable|integer|min:1',
            'weight' => 'nullable|numeric|min:0.001'
        ]);

        // Check if quantity or weight is provided
        $quantity = $this->quantity;
        $weight = $this->weight;

        if (!$quantity && !$weight) {
            $this->errorMessage = 'Either quantity or weight must be provided.';
            return;
        }

        $total = $quantity ? $this->inventory->sale_price * $quantity : $this->inventory->sale_price * $weight;
        $total_gst = ($total - 0) * $this->inventory->gst_rate / 100; // assuming discount is 0

        $existingCartItem = VendCart::where('customer_id', $this->customer->id)
            ->where('user_id', Auth::id())
            ->where('inventory_id', $this->inventory->id)
            ->whereNull('order_id')
            ->whereNull('deleted_at')
            ->first();

        if ($existingCartItem) {
            $this->errorMessage = 'Product already in cart.';
            return;
        }

        $quantity_available = $this->inventory->qty - VendCart::where('inventory_id', $this->inventory->id)->whereNotNull('order_id')->sum('quantity');
        $weight_available = $this->inventory->weight - VendCart::where('inventory_id', $this->inventory->id)->whereNotNull('order_id')->sum('weight');

        if (($quantity && $quantity > $quantity_available) || ($weight && $weight > $weight_available)) {
            $this->errorMessage = 'Quantity or weight not available.';
            return;
        }

        $vendor_cart = new VendCart();
        $vendor_cart->customer_id = $this->customer->id;
        $vendor_cart->user_id = Auth::id();
        $vendor_cart->inventory_id = $this->inventory->id;
        $vendor_cart->product_name = $this->inventory->product_name;
        $vendor_cart->quantity = $quantity;
        $vendor_cart->weight = $weight;
        $vendor_cart->price = $this->inventory->sale_price;
        $vendor_cart->total = $total;
        $vendor_cart->total_gst = $total_gst;
        $vendor_cart->discount = 0;
        $vendor_cart->save();

        $this->successMessage = 'Product added to cart.';

        // Clear the form
        $this->quantity = null;
        $this->weight = null;
        $this->barcode = null;
        $this->inventory = null;

        // Display livewire blade vendor-shopping-cart
        return redirect()->route('admin_sales.create');
        
    }

    public function render()
    {
        return view('livewire.barcode-scanner');
    }
}