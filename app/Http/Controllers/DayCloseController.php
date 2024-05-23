<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\user;
use App\Models\Vendor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DayCloseController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
            ->select('orders.id', 'orders.user_id', 'orders.status', 'orders.cash', 'orders.card', 'orders.upi', 'orders.created_at', 'orders.updated_at', 'vendors.vendor_name as vendor_name')
            ->leftjoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('vendors', 'users.id', '=', 'vendors.user_id')
            ->where('orders.status', '=', 'Pending')
            ->groupBy('orders.id', 'orders.user_id', 'orders.status', 'orders.created_at', 'orders.updated_at', 'vendors.vendor_name')
            ->get();
        $vendors = Vendor::all();

        if($orders){
            $total_orders = $orders->count();
            $total_cash = $orders->sum('cash');
            $total_card = $orders->sum('card');
            $total_upi = $orders->sum('upi');
            $total_amt = $orders->sum('cash') + $orders->sum('card') + $orders->sum('upi');
        }else{
            $total_orders = 0;
            $total_cash = 0;
            $total_card = 0;
            $total_upi = 0;
            $total_amt = 0;
        }
        
        
        return view('dayclose.index', compact('orders', 'vendors', 'total_orders', 'total_cash', 'total_card', 'total_upi', 'total_amt'));
    }

    public function search(Request $request)
    {
        $orders = DB::table('orders')
            ->select('orders.id', 'orders.user_id', 'orders.status', 'orders.cash', 'orders.card', 'orders.upi', 'orders.created_at', 'orders.updated_at', 'vendors.vendor_name as vendor_name')
            ->leftjoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('vendors', 'users.id', '=', 'vendors.user_id')
            ->where('orders.status', '=', 'Pending')
            ->where('orders.user_id', '=', $request->user_id)
            ->groupBy('orders.id', 'orders.user_id', 'orders.status', 'orders.created_at', 'orders.updated_at', 'vendors.vendor_name')
            ->get();
        $vendors = Vendor::all();

        if($orders){
            $total_orders = $orders->count();
            $total_cash = $orders->sum('cash');
            $total_card = $orders->sum('card');
            $total_upi = $orders->sum('upi');
            $total_amt = $orders->sum('cash') + $orders->sum('card') + $orders->sum('upi');
        }else{
            $total_orders = 0;
            $total_cash = 0;
            $total_card = 0;
            $total_upi = 0;
            $total_amt = 0;
        }

        return view('dayclose.index', compact('orders', 'vendors', 'total_orders', 'total_cash', 'total_card', 'total_upi', 'total_amt'));
    }

    public function updateStatus(Request $request)
    {
        $orderIds = $request->input('order_ids');
    
        // Update the status of the selected orders to 'Completed'
        DB::table('orders')
        ->whereIn('id', $orderIds)
        ->update(['status' => 'Completed']);

        return redirect()->route('admindashboard')->with('success', 'Order status updated successfully!');
}
}
