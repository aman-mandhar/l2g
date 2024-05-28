<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory;
use App\Models\VendCart;

class BarcodeReader extends Component
{
    public $barcode;
    public $quantity;
    public $weight;
    public $inventory;
    public $errorMessage;
    public $successMessage;

    public function updatedBarcode($value)
    {
        $this->fetchInventory($value);
    }

    public function fetchInventory($barcode)
    {
        $this->inventory = Inventory::where('qr_code', $barcode)->first();

        if (!$this->inventory) {
            $this->errorMessage = 'Product not found.';
            $this->inventory = null;
        } else {
            $this->errorMessage = null;
            $this->successMessage = 'Product found!';
        }
    }

    public function addToCart()
    {
        $user = Auth::user();
        if (!$user) {
            $this->errorMessage = 'User must be logged in.';
            return;
        }

        if (!$this->inventory) {
            $this->errorMessage = 'No product selected.';
            return;
        }

        $validatedData = $this->validate([
            'quantity' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
        ]);

        $quantity = $validatedData['quantity'] ?? null;
        $weight = $validatedData['weight'] ?? null;

        if (!$quantity && !$weight) {
            $this->errorMessage = 'Either quantity or weight must be provided.';
            return;
        }

        $total = $quantity ? $this->inventory->price * $quantity : $this->inventory->price * $weight;
        $total_gst = ($total - 0) * $this->inventory->gst_rate / 100; // assuming discount is 0

        $existingCartItem = VendCart::where('customer_id', $user->id)
            ->where('user_id', $user->id)
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
        $vendor_cart->customer_id = $user->id;
        $vendor_cart->user_id = $user->id;
        $vendor_cart->inventory_id = $this->inventory->id;
        $vendor_cart->product_name = $this->inventory->product_name;
        $vendor_cart->quantity = $quantity;
        $vendor_cart->weight = $weight;
        $vendor_cart->price = $this->inventory->price;
        $vendor_cart->total = $total;
        $vendor_cart->total_gst = $total_gst;
        $vendor_cart->discount = 0;
        $vendor_cart->save();

        $this->successMessage = 'Product added to cart.';
    }

    public function render()
    {
        return view('livewire.barcode-reader');
    }
}
