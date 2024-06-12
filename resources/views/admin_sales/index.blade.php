@extends('layouts.panels.admin_panel.dashboard')
@section('content')
    <table class="table table-striped">
        <h4>Sale Orders List</h4>
        <tr>
            <th>Order ID</th>
            <th>Amount</th>
            <th>Sold By</th>
            <th>Date</th>
            <th>Action</th>
            
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->amount }}</td>
                <td>{{ $order->Salesperson }}</td>
                <td>{{ $order->updated_at }}</td>
                <td><a href="{{ route('admin_orders.show', $order->id) }}">View</a></td>
                
            </tr>
        @endforeach
@endsection