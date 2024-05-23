@extends('layouts.panels.admin_panel.dashboard')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h6>Add New Stock</h6>
            <form action="{{ route('inventories.store') }}" method="POST">
                @csrf
            <table class="table">
                <tr>
                    <td><img src="{{ asset('storage/products/'.$product->prod_pic) }}" alt="Product Image Not Found" width="90px" height="90px"></td>
                    <td>
                        <label for="name">Product Name</label><br>
                        {{ $product->name }}
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                    </td>
                    <td>
                        @if ($product->type == '1')
                        
                            <label for="qty">Quantity</label>
                            <input type="number" name="qty" class="form-control" placeholder="Quantity">
                       
                        @elseif ($product->type == '2') 
                        
                            <label for="weight">Weight in kg.</label>    
                            <input type="number" name="weight" id="weight" class="form-control" placeholder="Weight" step="0.001">
                        
                        @endif
                    </td>
                    <td>
                        <label for="cost_price">Cost Price</label>
                        <input type="number" name="cost_price" class="form-control" placeholder="Cost Price">
                    </td>
                    <td>
                        <label for="mrp">MRP</label>
                        <input type="number" name="mrp" class="form-control" placeholder="MRP">
                    </td>
                    <td>
                        <label for="sale_price">Sale Price</label>
                        <input type="number" name="sale_price" class="form-control" placeholder="Sale Price">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="batch_no">Batch No</label>
                        <input type="text" name="batch_no" class="form-control" placeholder="Batch No">
                    </td>
                    <td>
                        <label for="mfg_date">Manufacturing Date</label>
                        <input type="date" name="mfg_date" class="form-control" placeholder="Manufacturing Date">
                    </td>
                    <td>
                        <label for="exp_date">Expire Date</label>
                        <input type="date" name="exp_date" class="form-control" placeholder="Expire Date">
                    </td>
                    <td>
                        <label for="remarks">Remarks</label>
                        <input type="text" name="remarks" class="form-control" placeholder="Remarks">
                    </td>
                </tr>
            </table> 
            <button type="submit" class="btn btn-primary">Next</button>
            </form>  
        </div>
    </div>
</div>
@endsection