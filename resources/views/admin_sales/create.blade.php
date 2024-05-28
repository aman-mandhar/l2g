@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@php 
    $customer = session()->get('customer');
    $prod = session()->get('prods');
@endphp

       <!-- row -->
        <div class="col-md-6">
            <h4>New Sale</h4>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="table">
                       <table class="table">
                          <thead>
                             <tr>
                                <th>Customer Name</th>
                                <th>Mobile Number</th>
                             </tr>
                          </thead>
                          <tbody>
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->mobile_number }}</td>
                            </tr>
                          </tbody>
                        </table>
                        @livewire('vendor-shopping-cart')
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
               <div class="full graph_head">
                  <div class="heading1 margin_0">
                     <h2>Use Barcode</h2>
                  </div>
                  <div class="row"> 
                  <div class="col-md-6">
                     @livewire('barcode-scanner')
                  </div>
                  </div>
               </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
               <div class="full graph_head">
                  <div class="heading1 margin_0">
                     <h2>Manual Search</h2>
                  </div>
               </div>
               <form action="{{ route('admin_sales.searchproduct') }}" method="GET">
                <div class="form-group">
                    <label for="search">Search</label>
                    <input type="text" id="search" name="search" class="form-control" placeholder="Enter a keyword">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
               </form>
               <div class="table_section padding_infor_info">
                  <div class="table-responsive-sm">
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
                                <form action="{{ route('admin_sales.addtocart') }}" method="POST">
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


