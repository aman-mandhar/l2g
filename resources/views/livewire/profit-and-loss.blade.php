<div class="midde_cont">
    <div class="container-fluid">
       <div class="row column_title">
          <div class="col-md-12">
             <div class="page_title">
                <h2>Dashboard</h2>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-3">
             <div class="card">
                <div class="card-body">
                   <h5 class="card-title">Total Summary</h5>
                     <p class="card-text">Total Sale: {{ $products->sum('sale') }}</p>
                        <p class="card-text">Total Cost: {{ $products->sum('cost_price') }}</p>
                        <p class="card-text">Total Profit: {{ $products->sum('sale') - $products->sum('cost_price') }}</p>
                </div>
             </div>
          </div>
       </div>
      <!-- row -->
       <div class="col-md-6">
         <h4>Sale Report</h4>
      </div>
       <div class="row">
       <!-- table section -->
       <table class="table">
        <thead>
            <tr>
                <th>Order Id</th>
                <td>Product Name</td>
                <td>Category</td>
                <td>Subcategory</td>
                <td>Colour</td>
                <td>Size</td>
                <td>Weight</td>
                <td>Length</td>
                <td>Liquid Volume</td>
                <td>Cost Price</td>
                <td>Sale Price</td>
                <td>Total Sales</td>
                <td>Profit</td>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->category_name }}</td>
                <td>{{ $product->subcategory_name }}</td>
                <td>{{ $product->colour }}</td>
                <td>{{ $product->size }}</td>
                <td>{{ $product->weight }}</td>
                <td>{{ $product->length }}</td>
                <td>{{ $product->liquid }}</td>
                <td>{{ $product->cost_price }}</td>
                <td>{{ $product->sale_price }}</td>
                <td>{{ $product->total_sales }}</td>
                <td>{{ $product->profit }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $products->links() }}
         
        
       </div>
    </div>
</div>