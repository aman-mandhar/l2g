<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div x-data="{ open: false }">
                <button @click="open = !open">View Cart</button>
                <div x-show="open" @click.outside="open = false">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Sale Price</th>
                                    <th>Qty. / Weight</th>
                                    <th>Spl Discount</th>
                                    <th>Sub-Total</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($carts->isEmpty())
                                <tr>
                                    <td colspan="6">No items in cart</td>
                                </tr>
                                @else
                                @foreach($carts as $cart)
                                <tr>
                                    <td>{{ $cart->product_name }}</td>
                                    <td>{{ $cart->price }}</td>
                                    <td>{{ $cart->quantity }}{{ $cart->weight }}</td>
                                    <td>{{ $cart->discount }}</td>
                                    <td>{{ $cart->total }}</td>
                                    <td>
                                        <button wire:click="removeFromCart({{ $cart->id }})" class="btn btn-danger">Remove</button>
                                    </td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>
                                        <b>Total of Spl. Discount</b><br>
                                        <input type="text" wire:model="discount" class="form-control" value="{{ $carts->sum('discount') }}" readonly>
                                    </td>
                                    <td>
                                        <b>Total Amount</b><br>
                                        <input type="text" wire:model="total" class="form-control" value="{{ $carts->sum('total') }}" readonly>    
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6">
                                        <a href="{{ route('vendor_sales.create') }}" class="btn btn-primary">Continue Shopping</a>
                                        <a href="{{ route('vendor_sales.checkout') }}" class="btn btn-success">Checkout</a>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

