<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="col-md-12">
                    <h4>Customer Details</h4>
                    <tr>
                        <td>CUSTOMER - {{ $customer->name }} / Mob. No. {{ $customer->mobile_number }}</td>
                    </tr>
                </table>
                <hr>
                <table>
                    <h4>Items in Cart</h4>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Qty. / Weight</th>
                            <th>Sale Price</th>
                            <th>Spl Discount</th>
                            <th>GST</th>
                            <th>Sub-Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody  class="col-md-12">
                        
                        @if($carts)
                            
                            @foreach($carts as $cart)
                            <tr>
                                <td>{{ $cart->product_name }}</td>
                                <td>{{ $cart->quantity }}{{ $cart->weight }}</td>
                                <td>{{ $cart->price }}</td>
                                <td>{{ $cart->discount }}</td>
                                <td>{{ number_format($cart->total_gst, 2) }}</td>
                                <td>{{ $cart->total }}</td>
                                <td>
                                    <button wire:click="removeFromCart({{ $cart->id }})" class="btn btn-danger">Remove</button>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9">No Items in Cart</td>
                            </tr>
                        @endif
                        <tr>
                            <td>
                                <b>Total GST</b><br>
                                {{ $total_gst }}
                            </td>
                            <td>
                                <b>Total Amount</b><br>
                                {{ $total_amount }}    
                            </td>
                            <td>
                                <b>Amount Payable</b><br>
                                {{ ceil($amt_payable) }}
                            </td>
                            <td>
                                <div class="form-group">
                                    <b>Spl. discount applying : {{ $total_discount }}</b><br>
                                </div>
                            </td>
                        </tr>
                        <form wire:submit.prevent="savePayment">
                        <tr>
                            <td>
                                Cash<br>
                                <input type="number" wire:model.lazy="cash" class="form-control" step="0.01">        
                            </td>
                            <td>
                                Card<br>
                                <input type="number" wire:model.lazy="card" class="form-control" step="0.01">
                            </td>
                            <td>
                                UPI<br>
                                <input type="number" wire:model.lazy="upi" class="form-control" step="0.01">
                            </td>
                            <td>
                                <b>More to Pay : {{$amt_payable}}</b>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary">Save Payment</button>
                            </td>
                        </tr>
                        </form>
                    </tbody>
                </table>
                <div">
                    <a href="{{ route('vendor_sales.create') }}" class="btn btn-primary">Add more Items</a>
                </div>
            </div>
        </div>
    </div>
</div>

