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

    public function mount()
    {
        $this->loadOrders();
        $this->vendors = Vendor::all();
    }

    public function loadOrders()
    {
        $this->orders = DB::table('orders')
            ->select('orders.id', 'orders.user_id', 'orders.status', 'orders.cash', 'orders.card', 'orders.upi', 'orders.created_at', 'orders.updated_at', 'vendors.vendor_name as vendor_name')
            ->leftjoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('vendors', 'users.id', '=', 'vendors.user_id')
            ->where('orders.status', '=', 'Pending')
            ->groupBy('orders.id', 'orders.user_id', 'orders.status', 'orders.created_at', 'orders.updated_at', 'vendors.vendor_name')
            ->get();

        if($this->orders){
            $this->total_orders = $this->orders->count();
            $this->total_cash = $this->orders->sum('cash');
            $this->total_card = $this->orders->sum('card');
            $this->total_upi = $this->orders->sum('upi');
            $this->total_amt = $this->orders->sum('cash') + $this->orders->sum('card') + $this->orders->sum('upi');
        }else{
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
            ->select('orders.id', 'orders.user_id', 'orders.status', 'orders.cash', 'orders.card', 'orders.upi', 'orders.created_at', 'orders.updated_at', 'vendors.vendor_name as vendor_name')
            ->leftjoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('vendors', 'users.id', '=', 'vendors.user_id')
            ->where('orders.status', '=', 'Pending')
            ->where('orders.user_id', '=', $request->user_id)
            ->groupBy('orders.id', 'orders.user_id', 'orders.status', 'orders.created_at', 'orders.updated_at', 'vendors.vendor_name')
            ->get();

        if($this->orders){
            $this->total_orders = $this->orders->count();
            $this->total_cash = $this->orders->sum('cash');
            $this->total_card = $this->orders->sum('card');
            $this->total_upi = $this->orders->sum('upi');
            $this->total_amt = $this->orders->sum('cash') + $this->orders->sum('card') + $this->orders->sum('upi');
        }else{
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
