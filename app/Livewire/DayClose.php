<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DayClose extends Component
{
    public $orders;
    public $vendors;
    public $total_orders;
    public $total_cash;
    public $total_card;
    public $total_upi;
    public $total_amt;
    public $selectAll = false;
    public $selectedOrders = [];
    public $todays;
    public $all_orders;
    public $all_amount;
    public $all_cash;
    public $all_card;
    public $all_upi;
    public $all_cost;
    public $all_sales;
    public $all_profit;

    public function mount()
    {
    $this->vendors = Vendor::all();

    $this->todays = DB::table('orders')
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
        ->get();

    $this->all_orders = $this->todays->count();
    $this->all_amount = $this->todays->sum('amount');
    $this->all_cash = $this->todays->sum('cash');
    $this->all_card = $this->todays->sum('card');
    $this->all_upi = $this->todays->sum('upi');

    $this->all_cost = $this->todays->sum('cost');
    $this->all_sales = $this->all_amount;
    $this->all_profit = $this->all_sales - $this->all_cost;

    $this->loadOrders();
    }

    public function loadOrders()
    {
    $this->orders = DB::table('orders')
        ->select(
            'orders.id',
            'orders.user_id',
            'orders.status',
            'orders.cash',
            'orders.card',
            'orders.upi',
            'orders.created_at',
            'orders.updated_at',
            'vendors.vendor_name as vendor_name'
        )
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin('vendors', 'users.id', '=', 'vendors.user_id')
        ->where('orders.status', '=', 'Pending')
        ->groupBy(
            'orders.id',
            'orders.user_id',
            'orders.status',
            'orders.cash',
            'orders.card',
            'orders.upi',
            'orders.created_at',
            'orders.updated_at',
            'vendors.vendor_name'
        )
        ->get();

    if ($this->orders) {
        $this->total_orders = $this->orders->count();
        $this->total_cash = $this->orders->sum('cash');
        $this->total_card = $this->orders->sum('card');
        $this->total_upi = $this->orders->sum('upi');
        $this->total_amt = $this->total_cash + $this->total_card + $this->total_upi;
    } else {
        $this->total_orders = 0;
        $this->total_cash = 0;
        $this->total_card = 0;
        $this->total_upi = 0;
        $this->total_amt = 0;
    }
    }


    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedOrders = $this->orders->pluck('id')->toArray();
        } else {
            $this->selectedOrders = [];
        }
    }

    public function search(Request $request)
    {
    $this->orders = DB::table('orders')
        ->select(
            'orders.id',
            'orders.user_id',
            'orders.status',
            'orders.cash',
            'orders.card',
            'orders.upi',
            'orders.created_at',
            'orders.updated_at',
            'vendors.vendor_name as vendor_name'
        )
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin('vendors', 'users.id', '=', 'vendors.user_id')
        ->where('orders.status', '=', 'Pending')
        ->where('orders.user_id', '=', $request->user_id)
        ->groupBy(
            'orders.id',
            'orders.user_id',
            'orders.status',
            'orders.cash',
            'orders.card',
            'orders.upi',
            'orders.created_at',
            'orders.updated_at',
            'vendors.vendor_name'
        )
        ->get();

    if ($this->orders) {
        $this->total_orders = $this->orders->count();
        $this->total_cash = $this->orders->sum('cash');
        $this->total_card = $this->orders->sum('card');
        $this->total_upi = $this->orders->sum('upi');
        $this->total_amt = $this->total_cash + $this->total_card + $this->total_upi;
    } else {
        $this->total_orders = 0;
        $this->total_cash = 0;
        $this->total_card = 0;
        $this->total_upi = 0;
        $this->total_amt = 0;
    }
    }


    public function updateStatus()
    {
        Order::whereIn('id', $this->selectedOrders)->update(['status' => 'Completed']);
        session()->flash('message', 'Order status updated successfully.');
        $this->loadOrders();
        $this->selectedOrders = [];
        $this->selectAll = false;
    }

    public function render()
    {
        return view('livewire.day-close');
    }
}
