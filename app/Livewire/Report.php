<?php

namespace App\Livewire;

use GuzzleHttp\Psr7\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Carbon\Carbon;


use APP\Models\Inventory;
use APP\Models\Product;
use APP\Models\ProductCategory;
use APP\Models\ProductSubcategory;
use APP\Models\ProductVariation;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Order;
use App\Models\VendCart;

class Report extends Component
{
    use WithPagination;

    public $from_date;
    public $to_date;

    public function mount()
    {
        $this->from_date = date('Y-m-d');
        $this->to_date = date('Y-m-d');
    }

    public function loadSoldOuts()
    {
        $fromDateTime = Carbon::parse($this->from_date)->startOfDay();
        $toDateTime = Carbon::parse($this->to_date)->endOfDay();

        return DB::table('vend_carts')
            ->select(
                'vend_carts.*', 
                'vend_carts.product_name as name',
                'vend_carts.quantity as qty',
                'vend_carts.price as price',
                'vend_carts.total as total',
                'inventories.cost_price as cost',
                'vend_carts.updated_at as date'
            )
            ->leftJoin('inventories', 'vend_carts.inventory_id', '=', 'inventories.id')
            ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
            ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
            ->leftJoin('product_variations', 'products.variation_id', '=', 'product_variations.id')
            ->where('vend_carts.order_id', '!=', null)
            ->where('vend_carts.deleted_at', null)
            ->whereBetween('vend_carts.updated_at', [$fromDateTime, $toDateTime])
            ->paginate(20);
    }

    public function calculateTotals($soldOuts)
    {
        $totalCost = $soldOuts->sum(function($soldOut) {
            return $soldOut->cost * $soldOut->qty;
        });

        $totalPrice = $soldOuts->sum(function($soldOut) {
            return $soldOut->price * $soldOut->qty;
        });

        $totalProfit = $soldOuts->sum(function($soldOut) {
            return ($soldOut->price * $soldOut->qty) - ($soldOut->cost * $soldOut->qty);
        });

        return compact('totalCost', 'totalPrice', 'totalProfit');
    }

    public function searchSale()
    {
        $this->resetPage();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['from_date', 'to_date'])) {
            $this->searchSale();
        }
        $this->validateOnly($propertyName, [
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);
    }

    public function render()
    {
        $soldOuts = $this->loadSoldOuts();
        $totals = $this->calculateTotals($soldOuts);

        return view('livewire.report', [
            'soldOuts' => $soldOuts,
            'totalCost' => $totals['totalCost'],
            'totalPrice' => $totals['totalPrice'],
            'totalProfit' => $totals['totalProfit'],
        ]);
    }
}