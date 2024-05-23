<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Inventory;
use App\Models\VendCart;

class VendorStockBalance extends Component
{
    public $qty_in_stock;
    public $weight_in_stock;
    public $sold_qty;
    public $sold_weight;
    public $qty_remaining;
    public $weight_remaining;
    public $cart;
    public $stock;

    public function mount($prod_id)
    {
        $this->stock = Inventory::findOrFail($prod_id);
        $this->qty_in_stock = $this->stock->qty;
        $this->weight_in_stock = $this->stock->weight;
        $this->sold_qty = VendCart::where('inventory_id', $prod_id)
        ->where('order_id', '!=', null)
        ->sum('quantity');
        $this->sold_weight = VendCart::where('inventory_id', $prod_id)
        ->where('order_id', '!=', null)
        ->sum('weight');
        $this->qty_remaining = $this->qty_in_stock - $this->sold_qty;
        $this->weight_remaining = $this->weight_in_stock - $this->sold_weight;
    }

    public function render()
    {
        return view('livewire.vendor-stock-balance');
    }
}
