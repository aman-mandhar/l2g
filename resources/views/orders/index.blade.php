@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@include('layouts.panels.admin_panel.navbar')
    <table>
        <h4>Sale Orders List</h4>
        <tr>
            <th>Order ID</th>
            <th>Customer ID<br>Name<br>Tokens</th>
            <th>Referral ID<br>Name<br>Tokens</th>
            <th>Retail ID<br>Name<br>Tokens</th>
            <th>Shop ID<br>Name<br>Tokens</th>
            <th>Product Name</th>
            <th>Discount Coupens</th>
            <th>Amount</th>
            <th>GST</th>
            <th>Date</th>
            <th>Action</th>
            
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->order_id }}</td>
                <td>{{ $order->customer_id }}<br>{{ $order->customer_name }}<br>{{ $order->customer_tokens }}</td>
                <td>{{ $order->ref_id }}<br>{{ $order->ref_name }}<br>{{$order->ref_tokens}}</td>
                <td>{{ $order->retail_id }}<br>{{ $order->retail_name }}<br>{{ $order->retail_tokens }}</td>
                <td>{{ $order->shop_id }}<br>{{ $order->shop_name }}<br>{{ $order->shop_tokens }}</td>
                <td>{{ $order->item_name }}</td>
                <td>{{ $order->spl_coupens }}</td>
                <td>{{ $order->amount }}</td>
                <td>{{ $order->gst }}</td>
                <td>{{ $order->order_date }}</td>
                <td><a href="{{ route('orders.show', $order->order_id) }}">View</a></td>
                
            </tr>
        @endforeach
@endsection