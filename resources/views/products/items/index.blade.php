@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@include('layouts.panels.admin_panel.navbar')
    <div class="container">
        {{-- Search Form --}}
        <form action="{{ route('products.search') }}" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by name" name="search" id="search" value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </form>

        <h2>Item List</h2>

        {{-- Display Products --}}
        <table class="table table-bordered">
            
            <tbody>
                @forelse($items as $item)
                    
                    <tr>
                        <td>
                            <img src="{{ asset('images/' . $item->prod_pic) }}" alt="{{ $item->name }}" width="100">
                        </td>
                        <td><b>{{ $item->name }}<b></td>
                        <td><b>{{ $item->category->name }}<b></td>
                                            
                        @if($item->subCategory)
                        <td>
                            <span class="badge bg-secondary">{{ $item->subCategory->name }}</span>
                        </td>
                        @else
                        <td>
                            <span class="badge bg-secondary"><b>No Sub Category</b></span>
                        </td>
                        @endif
                        @if($item->variation)
                        <td>
                            <b>Variations:</b><br>
                            <span class="badge bg-secondary">{{ $item->variation->color }}</span>
                            <span class="badge bg-secondary">{{ $item->variation->size }}</span>
                            <span class="badge bg-secondary">{{ $item->variation->weight }}</span>
                            <span class="badge bg-secondary">{{ $item->variation->length }}</span>
                            <span class="badge bg-secondary">{{ $item->variation->liquid_volume }}</span>
                        </td>
                    @else
                        <td>
                            <span class="badge bg-secondary">No Variation</span>
                        </td>
                    @endif
                    <form action="{{ route('stocks.add', $item->id) }}" method="get">
                        <td>
                            <div class="form-group">
                                <label for="bill_id">Bill No.</label>
                                <select name="bill_id" id="bill_id" class="form-control">
                                    @foreach($purchases->sortByDesc('created_at') as $purchase)
                                        <option value="{{ $purchase->id }}">{{ $purchase->bill_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        
                    </tr>
                    <tr>
                            <td>
                                <div class="form-group">
                                    @if ($item->type == 'Pack')
                                        <label for="qty">Quantity</label>
                                        <input type="number" name="qty" id="qty" class="form-control" required placeholder="Quantity" step="0.01">
                                    @elseif ($item->type == 'Loose') 
                                        <label for="weight">Weight</label>
                                        <input type="number" name="weight" id="weight" class="form-control" required placeholder="Weight" step="0.001">
                                        @endif
                                </div>
                            </td>
                        <td>
                            <div class="form-group">
                                <label for="pur_value">Rate</label>
                                <input type="number" name="pur_value" id="pur_value" class="form-control" required placeholder="Amount" step="0.01">
                            </div>    
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="gst">Extra Exp.</label>
                                <input type="number" name="expences" id="expences" class="form-control" required placeholder="Extra Exp." step="0.01">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="mrp">MRP</label>
                                <input type="number" name="mrp" id="mrp" class="form-control" required placeholder="MRP" step="0.01">
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <label for="sale_price">ZK Price</label>
                                <input type="number" name="sale_price" id="sale_price" class="form-control" required placeholder="ZK Price" step="0.01">
                            </div>
                        </td>
                        
                        <td>
                            <button type="submit" class="btn btn-success">Add Stock</button>
                            <a href="{{ route('products.items.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('products.items.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            
                        </td>
                        </form>
                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No items found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Add Item Button --}}
        <a href="{{ route('products.items.create') }}" class="btn btn-success">Add Item</a>
    </div>



    <script>
        document.getElementById('search').addEventListener('input', function () {
            var searchValue = this.value.trim().toLowerCase();
    
            // Loop through each row in the table body
            document.querySelectorAll('.item-row').forEach(function (row) {
                var itemName = row.querySelector('td:first-child').textContent.trim().toLowerCase();
                row.style.display = itemName.includes(searchValue) ? 'table-row' : 'none';
            });
        });
    </script>
    
@endsection
