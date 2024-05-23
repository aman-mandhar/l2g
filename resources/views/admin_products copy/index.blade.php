@extends('layouts.panels.admin_panel.vendorlayout')
@section('content')

<div class="col-md-9">
    <div class="white_shd full margin_bottom_30">
       <div class="full graph_head">
          <div class="heading1 margin_0">
             <h2>Bordered Table</h2>
          </div>
       </div>
       <div class="table_section padding_infor_info">
          <div class="table-responsive-sm">
             <table class="table table-bordered">
                <thead>
                   <tr>
                      <th>Product Name</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>GST Rate</th>
                        <th>Description</th>
                   </tr>
                </thead>
                <tbody>
                   @foreach($products as $product)
                   <tr>
                      <td>{{ $product->name }}</td>
                      <td><img src="{{ asset('storage/'.$product->product_image) }}" alt="product image" style="width: 50px; height: 50px;"></td>
                      <td>{{ $product->category->name }}</td>
                      <td>{{ $product->gst }}</td>
                      <td>{{ $product->description }}</td>
                   </tr>
                   @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection