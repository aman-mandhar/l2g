<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\Retail;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
            ->select('orders.*',
            'carts.*',
            'users.*',
            'customers.*',
            'stores.*',
            'shops.*',
            'orders.id as order_id',
            'orders.customer_id as customer_id',
            'customers.name as customer_name',
            'carts.customer_tokens as customer_tokens',
            'customers.ref_mobile_number as ref_mobile_number',
            'referrals.id as ref_id',
            'referrals.name as ref_name',
            'carts.ref_tokens as ref_tokens',
            'orders.user_id as user_id',
            'users.name as user_name',
            'stores.user_id as retail_id',
            'stores.store_name as retail_name',
            'carts.retail_tokens as retail_tokens',
            'shops.user_id as shop_id',
            'carts.shop_tokens as shop_tokens',
            'carts.discount as spl_coupens',
            'orders.amount as total_amount',
            'orders.gst as gst',
            'orders.created_at as order_date',
            'items.name as item_name',

            
            )
            ->leftJoin('carts', 'orders.id', '=', 'carts.order_id')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('users as customers', 'orders.customer_id', '=', 'customers.id')
            ->leftJoin('users as referrals', 'customers.ref_mobile_number', '=', 'referrals.mobile_number')
            ->leftJoin('stores', 'orders.user_id', '=', 'stores.user_id')
            ->leftJoin('shops', 'orders.user_id', '=', 'shops.user_id')
            ->leftJoin('stocks', 'carts.product_id', '=', 'stocks.id')
            ->leftJoin('items', 'stocks.item_id', '=', 'items.id')
            ->get();
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        $products = DB::table('carts')
            ->select('carts.*', 'carts.quantity as quantity', 'carts.weight as item_weight', 'carts.price as price', 'carts.total as total', 'stocks.*', 'items.name as item_name')
            ->leftJoin('stocks', 'carts.product_id', '=', 'stocks.id')
            ->leftJoin('items', 'stocks.item_id', '=', 'items.id')
            ->where('order_id', $id)
            ->get();
        $customer = User::where('id', $order->customer_id)->first();
        $user = User::where('id', $order->user_id)->first(); 

        return view('orders.show', compact('order', 'products', 'customer', 'user'));
    }


    
}
