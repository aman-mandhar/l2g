<div>
    <input type="text" wire:model.lazy="barcode" placeholder="Scan barcode here" autofocus />

    @if ($errorMessage)
        <div class="alert alert-danger">
            {{ $errorMessage }}
        </div>
    @endif

    @if ($successMessage)
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endif

    @if ($inventory)
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <form wire:submit.prevent="addToCart">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Sale Price</th>
                            <th>Qty. / Weight</th>
                            <th>Sub-Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $inventory->product_name }}</td>
                            <td>{{ $inventory->sale_price }}</td>
                            <td>
                                @php 
                                    $product = App\Models\Product::findOrFail($inventory->product_id);
                                @endphp
                                @if($product->type == '1')
                                    <input type="number" wire:model.lazy="quantity" class="form-control" step="1">
                                @else
                                    <input type="number" wire:model.lazy="weight" class="form-control" step="0.01">
                                @endif
                            </td>
                            <td>
                                @if($product->type == '1')
                                    {{ $inventory->sale_price * $quantity }}
                                @else
                                    {{ $inventory->sale_price * $weight }}
                                @endif
                            </td>
                            <td>
                                <input type="hidden" wire:model="inventory_id" value="{{ $inventory->id }}">
                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
