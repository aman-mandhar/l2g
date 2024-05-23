@extends('layouts.panels.admin_panel.dashboard')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h6>Stock Saved Successfully</h6>
            <table class="table">
                <tr>
                    <td><img src="{{ asset('storage/products/'.$product->prod_pic) }}" alt="Product Image Not Found" width="90px" height="90px"></td>
                    <td>
                        <label for="name">Product Name</label><br>
                        {{ $product->name }}
                    </td>
                    <td>
                        @if ($product->type == '1')
                            <label for="qty">Quantity</label><br>
                            {{ $inventory->qty }}
                        @elseif ($product->type == '2')
                            <label for="weight">Weight in kg.</label><br>
                            {{ $inventory->weight }}
                        @endif
                    </td>
                    <td>
                        <label for="cost_price">Cost Price</label><br>
                        {{ $inventory->cost_price }}
                    </td>
                    <td>
                        <label for="mrp">MRP</label><br>
                        {{ $inventory->mrp }}
                    </td>
                    <td>
                        <label for="sale_price">Sale Price</label><br>
                        {{ $inventory->sale_price }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="batch_no">Batch No</label><br>
                        {{ $inventory->batch_no }}
                    </td>
                    <td>
                        <label for="mfg_date">Manufacturing Date</label><br>
                        {{ $inventory->mfg_date }}
                    </td>
                    <td>
                        <label for="exp_date">Expire Date</label><br>
                        {{ $inventory->exp_date }}
                    </td>
                    <td>
                        <label for="remarks">Remarks</label><br>
                        {{ $inventory->remarks }}
                    </td>
                </tr>
                <tr>
                    <td><label for="vendor_tokens">Vendor Tokens</label><br>
                        {{ $inventory->vendor_tokens }}
                    </td>
                    <td><label for="vendor_ref_tokens">Vendor Referral Tokens</label><br>
                        {{ $inventory->vendor_ref_tokens }}
                    </td>
                    <td><label for="customer_tokens">Customer Tokens</label><br>
                        {{ $inventory->customer_tokens }}
                    </td>
                    <td><label for="ref_tokens">Customer Referral Tokens</label><br>
                        {{ $inventory->ref_tokens }}
                    </td>
                    <td><label for="discount">Spl. Discount</label><br>
                        {{ $inventory->discount }}
                    </td>
                </tr>
                <tr>
                    <td><label for="qr_code">QR Code</label><br>
                        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($inventory->qr_code, 'C39',1,33,array(1,1,1)) }}" alt="barcode" />
                        <p>p - {{ $inventory->qr_code }}</p>
                    </td>
                    
            </table>
        </div>
        <div class="col-md-12">
            <a href="{{ route('inventories.addstock') }}" class="btn btn-primary">Add More Stock</a>
        </div>
    </div>
</div>
@endsection
