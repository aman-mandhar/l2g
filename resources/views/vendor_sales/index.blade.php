@extends('layouts.panels.vendor_panel.vendorlayout')
@section('content')
    <table class="table table-striped">
        <h4>Sale Orders List</h4>
        <tr>
            <th>Order ID</th>
            <th>Product Name</th>
            <th>Discount Coupens</th>
            <th>Amount</th>
            <th>GST</th>
            <th>Date</th>
            <th>Action</th>
            
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->amount }}</td>
                <td>{{ $order->gst }}</td>
                <td>{{ $order->created_at }}</td>
                <td><a href="{{ route('vendor_orders.show', $order->id) }}">View</a></td>
                
            </tr>
        @endforeach
@endsection