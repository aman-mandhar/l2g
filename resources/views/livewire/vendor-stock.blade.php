<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Vendor Stock</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <form wire:submit.prevent="searchProduct">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" wire:model="search" placeholder="Search Product">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Category Name</th>
                                    <th>New Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products_query as $product)
                                <tr>
                                    <td><img src="{{ asset('storage/products/'.$product->prod_pic) }}" alt="" width="100" width="90px" height="90px"></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category_name }}</td>
                                    <td>
                                        <form wire:submit.prevent="addStock({{ $product->id }})">
                                            <input type="number" wire:model.lazy="qty" class="form-control" placeholder="Enter Quantity">
                                            <input type="mrp" wire:model.lazy="mrp" class="form-control" placeholder="Enter MRP">
                                            <input type="price" wire:model.lazy="sale_price" class="form-control" placeholder="Enter Price">
                                            <button class="btn btn-primary">Add Stock</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                    @if($vendor_tokens != null)
                    
                    <div class="card">
                        <div class="card-header">
                            <h4>Token Detail</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Vendor Tokens</th>
                                        <th>Vendor Ref's Tokens</th>
                                        <th>Customer Tokens</th>
                                        <th>Customer Ref's Tokens</th>
                                        <th>Spl. Discount</th>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $vendor_tokens }}</td>
                                        <td>{{ $vendor_ref_tokens }}</td>
                                        <td>{{ $customer_tokens }}</td>
                                        <td>{{ $ref_tokens }}</td>
                                        <td>{{ $discount }}</td>
                                        <td>
                                            <a href="{{ route('inventories.create') }}" class="btn btn-primary">Clear All</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="batch_no">Batch No</label>
                            <input type="text" wire:model.lazy="batch_no" class="form-control" placeholder="Enter Batch No">
                        </div>
                        <div class="form-group">
                            <label for="mfg_date">Mfg Date</label>
                            <input type="date" wire:model.lazy="mfg_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exp_date">Exp Date</label>
                            <input type="date" wire:model.lazy="exp_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea wire:model.lazy="remarks" class="form-control" placeholder="Enter Remarks"></textarea>
                        </div>
                        <button class="btn btn-primary">Save</button>
                    </form>
                    @endif
            </div>
        </div>
    </div>

