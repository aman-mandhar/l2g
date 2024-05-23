@extends('layouts.panels.vendor_panel.vendorlayout')
@include('layouts.panels.vendor_panel.navbar')
@section('content')

<div class="container">
        
        @php 
        $customer = session()->get('customer');
        $ref = session()->get('ref');
        $prod = session()->get('prods');
        @endphp
       
        <table class="col-md-12">
            <tr>
                <td>CUSTOMER - {{ $customer->name }} / Nob. No. {{ $customer->mobile_number }}</td>
            </tr>
            <tr>
                <td>
                    @livewire('vendor-shopping-cart')
                </td>
            </tr>
        </table>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('vendor_sales.searchproduct') }}" method="GET">
                    <div class="form-group">
                        <label for="search">Search</label>
                        <input type="text" id="search" name="search" class="form-control" placeholder="Enter a keyword">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="row">
            List of Stock
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Stock in Hand</th>
                            <th>Sale Price</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prods as $prod)
                        <tr>
                            <td>{{ $prod->product_name }}</td>
                            <td>
                                @php
                                    $stock = App\Models\Inventory::findOrFail($prod->id);
                                    $qty_in_stock = $stock->qty;
                                    $weight_in_stock = $stock->weight;
                                    $sold_qty = App\Models\VendCart::where('inventory_id', $prod->id)
                                    ->where('order_id', '!=', null)
                                    ->sum('quantity');
                                    $sold_weight = App\Models\VendCart::where('inventory_id', $prod->id)
                                    ->where('order_id', '!=', null)
                                    ->sum('weight');
                                    $qty = $qty_in_stock - $sold_qty;
                                    $weight = $weight_in_stock - $sold_weight;
                                @endphp
                                @if($prod->type == '1')
                                    {{ $qty }}
                                @else
                                    {{ $weight }}
                                @endif
                            </td>
                            <td>
                                {{ $prod->sale_price }}
                            </td>
                            <form action="{{ route('vendor_sales.addtocart') }}" method="POST">
                                @csrf 
                            <td>   
                                @if($prod->type == '1')
                                    <input type="numeric" name="quantity" placeholder="Enter quantity">
                                @else
                                    <input type="numeric" name="weight" placeholder="Enter weight">
                                @endif
                            </td>
                            <td>
                                <input type="hidden" name="customer_id" value="{{$customer->id}}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="inventory_id" value="{{$prod->id}}">
                                <input type="hidden" name="product_name" value="{{ $prod->product_name }}">
                                <input type="hidden" name="price" value="{{ $prod->sale_price }}">
                                <input type="hidden" name="discount" value="{{ $prod->discount }}">
                                <input type="hidden" name="gst_rate" value="{{ $prod->gst_rate }}">
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>                
        </div>
    </div>    
</div>
   
@endsection


