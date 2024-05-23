<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\Vendor;
use App\Models\VendCart;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;

class VendorOrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
        ->select('orders.*', 
                 'products.name as product_name', 
                 'product_categories.name as category',
                 'product_subcategories.name as subcategory',
                 'product_variations.color as color',
                 'product_variations.size as size',
                 'product_variations.weight as weight',
                 'product_variations.length as length',
                 'product_variations.liquid_volume as liquid_volume',
                 'vend_carts.quantity as quantity',
                 'vend_carts.weight as item_weight',
                 'vend_carts.price as item_price',
                 'vend_carts.discount as item_discount',
                 'vend_carts.total as item_total',
                 'orders.amount as order_total',
                 'orders.spl_discount as order_discount',
                 'orders.gst as order_gst',
                 'orders.cash as order_cash',
                 'orders.card as order_card',
                 'orders.upi as order_upi',)
        ->leftJoin('vend_carts', 'orders.id', '=', 'vend_carts.order_id')
        ->leftJoin('inventories', 'vend_carts.inventory_id', '=', 'inventories.id')
        ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
        ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
        ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
        ->leftjoin('product_variations', 'products.variation_id', '=', 'product_variations.id')
        ->where('orders.user_id', auth()->user()->id)->get();
        return view('vendor_orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::find($id);
        $shop = Shop::where('user_id', '=', 1)->first();
        $customer = User::find($order->customer_id);
        $orderItems = DB::table('orders')
                    ->select('orders.*', 
                             'products.name as product_name', 
                             'product_categories.name as category',
                             'product_subcategories.name as subcategory',
                             'product_variations.color as color',
                             'product_variations.size as size',
                             'product_variations.weight as weight',
                             'product_variations.length as length',
                             'product_variations.liquid_volume as liquid_volume',
                             'vend_carts.quantity as quantity',
                             'vend_carts.weight as item_weight',
                             'vend_carts.price as item_price',
                             'vend_carts.discount as item_discount',
                             'vend_carts.total as item_total',
                             'orders.amount as order_total',
                             'orders.spl_discount as order_discount',
                             'orders.gst as order_gst',
                             'orders.cash as order_cash',
                             'orders.card as order_card',
                             'orders.upi as order_upi',)
                    ->leftJoin('vend_carts', 'orders.id', '=', 'vend_carts.order_id')
                    ->leftJoin('inventories', 'vend_carts.inventory_id', '=', 'inventories.id')
                    ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
                    ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
                    ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
                    ->leftjoin('product_variations', 'products.variation_id', '=', 'product_variations.id')
                    ->where('vend_carts.order_id', $order->id)
                    ->where('order_id', $order->id)->get();
        $amt_paid = ($order->cash + $order->card + $order->upi + $order->redeem);
        return view('vendor_orders.show', compact('order', 'orderItems', 'shop', 'customer', 'amt_paid'));
    }
}
