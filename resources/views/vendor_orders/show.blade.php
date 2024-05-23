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
        <div class="col-md-6">
            <p>
                <h4>GST Number - {{ $shop->gst_no }}</h4>
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
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Customer Phone</th>
                        <th>Order Date</th>
                        <th>Billed by</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->mobile_number }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <table class="table table-bordered">
                <h4>Items in Order</h4>
                <thead>
                    <tr>
                        <th>Product Details</th>
                        <th>Qty. / Weight</th>
                        <th>Sale Price</th>
                        <th>Spl Discount</th>
                        <th>Sub-Total</th>
                    </tr>
                </thead>
                <tbody  class="col-md-12">
                    @if($orderItems)
                        @foreach($orderItems as $orderItem)
                        <tr>
                            <td>
                                {{ $orderItem->product_name }} -
                                {{ $orderItem->category }} -
                                {{ $orderItem->subcategory }} -
                                {{ $orderItem->color }} -
                                {{ $orderItem->size }} -
                                {{ $orderItem->weight }} -
                                {{ $orderItem->length }} -
                                {{ $orderItem->liquid_volume }}
                            </td>
                            <td>
                                {{ $orderItem->quantity }}
                                {{ $orderItem->item_weight }}
                            </td>
                            <td>{{ number_format($orderItem->item_price. 2) }}</td>
                            <td>{{ number_format($orderItem->item_discount, 2) }}</td>
                            <td>{{ number_format($orderItem->item_total, 2) }}</td>
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
                        <th>Discount</th>
                        <th>GST</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ number_format($order->spl_discount, 2) }}</td>
                        <td>{{ number_format($order->gst, 2) }}</td>
                        <td>{{ number_format($amt_paid, 2) }}</td>
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
                        <th>Cash</th>
                        <th>Cheque</th>
                        <th>Upi</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>{{ number_format($order->cash, 2) }}</td>
                            <td>{{ number_format($order->card, 2) }}</td>
                            <td>{{ number_format($order->upi, 2) }}</td>
                        </tr>
                </tbody>
            </table>
            <a href="{{ route('vendor_sales.usercheck') }}" class="btn btn-primary">New Sale</a>
            <button class="btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
</div>
    
@endsection