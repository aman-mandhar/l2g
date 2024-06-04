<?php

namespace App\Livewire;

use Livewire\Component;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Livewire\WithPagination;
use Illuminate\Support\Collection;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\ProductVariation;
use App\Models\Inventory;
use App\Models\VendCart;
use App\Models\Vendor;
use App\Models\Order;

class ProfitAndLoss extends Component
{
    use WithPagination;

    public $all_orders;
    public $all_amount;
    public $all_cash;
    public $all_card;
    public $all_upi;
    public $all_cost;
    public $all_sales;
    public $all_profit;
    public $products = [];

    public function mount()
    {
        $paginatedProducts = DB::table('orders')
            ->select(
                'orders.id',
                'orders.amount',
                'orders.cash',
                'orders.card',
                'orders.upi',
                DB::raw('SUM(inventories.cost_price) as cost')
            )
            ->leftJoin('vend_carts', 'orders.id', '=', 'vend_carts.order_id')
            ->leftJoin('inventories', 'vend_carts.inventory_id', '=', 'inventories.id')
            ->where('orders.status', '=', 'pending')
            ->groupBy('orders.id')
            ->paginate(20);

        // Convert paginated products to array
        $this->products = $paginatedProducts->items();

        // Convert products to collection for calculations
        $productsCollection = Collection::make($this->products);

        $this->all_amount = $productsCollection->sum('amount');
        $this->all_cash = $productsCollection->sum('cash');
        $this->all_card = $productsCollection->sum('card');
        $this->all_upi = $productsCollection->sum('upi');
        $this->all_cost = $productsCollection->sum('cost');
        $this->all_orders = $productsCollection->count();
        $this->all_sales = $this->all_amount;
        $this->all_profit = $this->all_sales - $this->all_cost;
    }

    public function render()
    {
        return view('livewire.profit-and-loss', [
            'paginatedProducts' => DB::table('orders')
                ->select(
                    'orders.id',
                    'orders.amount',
                    'orders.cash',
                    'orders.card',
                    'orders.upi',
                    DB::raw('SUM(inventories.cost_price) as cost')
                )
                ->leftJoin('vend_carts', 'orders.id', '=', 'vend_carts.order_id')
                ->leftJoin('inventories', 'vend_carts.inventory_id', '=', 'inventories.id')
                ->where('orders.status', '=', 'pending')
                ->groupBy('orders.id')
                ->paginate(20)
        ]);
    }
}