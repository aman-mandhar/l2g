@extends('layouts.panels.admin_panel.dashboard')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h6>Add New Stock</h6>
            
                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td><img src="{{ asset('storage/products/'.$product->prod_pic) }}" alt="Product Image Not Found" width="90px" height="90px"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category_name }}</td>
                            <td>
                                <form action="{{ route('inventories.addnewstock') }}" method = "GET">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-primary">Add Stock</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
</div>
@endsection