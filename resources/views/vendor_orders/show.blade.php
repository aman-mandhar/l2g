@extends('layouts.panels.vendor_panel.vendorlayout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <p> 
                <h2>{{ $shop->shop_name }}</h2>
                <h4>{{ $shop->add }}</h4>
                <h4>Contact No. - {{ $shop->mobile_no }}</h4>
            </p>
        </div>
        
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <h4>Order Details</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><h5>Order ID</h5></th>
                        <th><h5>Order Date</h5></th>
                        <th><h5>Billed by</h5></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><h5>{{ $order->id }}</h5></td>
                        <td><h5>{{ $order->created_at }}</h5></td>
                        <td><h5>{{ $order->status }}</h5></td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <table class="table table-bordered">
                <h4>Items in Order</h4>
                <thead>
                    <tr>
                        <th><h5>Product Details</h5></th>
                        <th><h5>Qty. / Weight</h5></th>
                        <th><h5>Sale Price</h5></th>
                        <th><h5>Sub-Total</h5></th>
                    </tr>
                </thead>
                <tbody  class="col-md-12">
                    @if($orderItems)
                        @foreach($orderItems as $orderItem)
                        <tr>
                            <td><h5>
                                {{ $orderItem->product_name }} -
                                {{ $orderItem->category }} -
                                {{ $orderItem->subcategory }} -
                                {{ $orderItem->color }} -
                                {{ $orderItem->size }} -
                                {{ $orderItem->weight }} -
                                {{ $orderItem->length }} -
                                {{ $orderItem->liquid_volume }}
                            </h5></td>
                            <td><h5>
                                {{ $orderItem->quantity }}
                                {{ $orderItem->item_weight }}
                            </h5></td>
                            <td><h5>{{ number_format($orderItem->item_price. 2) }}</h5></td>
                            <td><h5>{{ number_format($orderItem->item_total, 2) }}</h5></td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <hr>
            <table class="table table-bordered">
                <h4>Order Summary</h4>
                <thead>
                    <tr>
                        <th><h5>Total</h5></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><h5>{{ number_format($amt_paid, 2) }}</h5></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h4>Payment Details</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><h5>Cash</h5></th>
                        <th><h5>Cheque</h5></th>
                        <th><h5>Upi</h5></th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td><h5>{{ number_format($order->cash, 2) }}</h5></td>
                            <td><h5>{{ number_format($order->card, 2) }}</h5></td>
                            <td><h5>{{ number_format($order->upi, 2) }}</h5></td>
                        </tr>
                </tbody>
            </table>
            <a href="{{ route('vendor_sales.usercheck') }}" class="btn btn-primary">New Sale</a>
            <button class="btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
</div>
    
@endsection