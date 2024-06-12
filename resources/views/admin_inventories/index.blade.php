@extends('layouts.panels.admin_panel.dashboard')
@section('content')
    <div class="container">
        <h1>Inventory</h1>
                
        <div class="row">
            <div class="col-md-3">
                <h5>Search by Name</h5>
                <form action="{{ route('admin_inventories.search') }}" method="GET">
                    <div class="form-group">
                        <label for="search">Search</label>
                        <input type="text" id="search" name="search" class="form-control" placeholder="Enter a keyword">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-9">
                <h5>Advance Search</h5>
                <form action="{{ route('admin_inventories.dateSearch') }}" method="GET">
                    <div class="form-group">
                        <label for="from">From</label>
                        <input type="date" id="from" name="from" class="form-control">
                        <label for="to">To</label>
                        <input type="date" id="to" name="to" class="form-control">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Stock Id</th>
                            <th>Product Name</th>
                            <th>Cost Price</th>
                            <th>Sale Price</th>
                            <th>Stock in Hand</th>
                            <th>Barcode</th>
                            <th>Date</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventories as $inventory)
                            <tr>
                                <td>{{ $inventory->id }}</td>
                                <td>{{ $inventory->product_name }}</td>
                                <td>{{ $inventory->cost_price }}</td>
                                <td>{{ $inventory->sale_price }}</td>
                                <td>
                                    <!-- Fetching Balance Stock -->
                                    @php
                                    $stock = App\Models\Inventory::findOrFail($inventory->id);
                                    $qty_in_stock = $stock->qty;
                                    $weight_in_stock = $stock->weight;
                                    $sold_qty = App\Models\VendCart::where('inventory_id', $inventory->id)
                                    ->where('order_id', '!=', null)
                                    ->sum('quantity');
                                    $sold_weight = App\Models\VendCart::where('inventory_id', $inventory->id)
                                    ->where('order_id', '!=', null)
                                    ->sum('weight');
                                    $qty = $qty_in_stock - $sold_qty;
                                    $weight = $weight_in_stock - $sold_weight;
                                @endphp
                                @if($inventory->product_type == '1')
                                    {{ $qty }}
                                @else
                                    {{ $weight }}
                                @endif

                                </td>
                                <td>
                                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($inventory->qr_code, 'C39',1,33,array(1,1,1)) }}" alt="barcode" />
                                    <p>p - {{ $inventory->qr_code }}</p>
                                </td>
                                <td>{{ $inventory->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            <button type="button" class="btn btn-primary" onclick="window.print()">Print</button>     
    </div>

@endsection