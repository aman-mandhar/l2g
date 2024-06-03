<?php

namespace App\Livewire;

use Livewire\Component;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Livewire\WithPagination;

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

    public function render()
    {
        // Calculate profit and loss
        $products = DB::table('orders')
            ->select(
                'orders.id',
                'products.name as product_name',
                'product_categories.name as category_name',
                'product_subcategories.name as subcategory_name',
                'product_variations.color as colour',
                'product_variations.size as size',
                'product_variations.weight as weight',
                'product_variations.length as length',
                'product_variations.liquid_volume as liquid',
                'orders.created_at as date',
                'orders.amount as sale',
                'inventories.qty as stock',
                'inventories.cost_price as cost_price',
                'inventories.sale_price as sale_price',
                DB::raw('SUM(orders.amount) as total_sales'),
                DB::raw('SUM(inventories.cost_price) as total_cost'),
                DB::raw('SUM(orders.amount) - SUM(inventories.cost_price) as profit')
            )
            ->leftJoin('vend_carts', 'orders.id', '=', 'vend_carts.order_id')
            ->leftJoin('inventories', 'vend_carts.inventory_id', '=', 'inventories.id')
            ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
            ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
            ->leftJoin('product_variations', 'products.variation_id', '=', 'product_variations.id')
            ->whereNotNull('vend_carts.order_id')
            ->whereNull('vend_carts.deleted_at')
            ->groupBy('orders.id', 'products.id', 'product_categories.id', 'product_subcategories.id', 'product_variations.id', 'inventories.id')
            ->paginate(20);

        return view('livewire.profit-and-loss', ['products' => $products]);
    }
}