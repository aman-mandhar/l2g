@extends('layouts.panels.admin_panel.dashboard')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h6>Search Product</h6>
            <form action="{{ route('admin_inventories.searchProduct') }}" method="GET">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Search Product">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td><img src="{{ asset('storage/products/'.$product->prod_pic) }}" alt="Product Image Not Found" width="90px" height="90px"></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category_name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection