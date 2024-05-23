<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="col-md-12">
                    <h4>Customer Details</h4>
                    <tr>
                        <td>CUSTOMER - {{ $customer->name }} / Mob. No. {{ $customer->mobile_number }}</td>
                        <td>REF. BY - {{$ref_name->name}} / Mob. No.:- {{$ref_mob}}</td>
                        <td>SPL. DIS. Coupens - {{$discount_on_spl_coupens}}</td>
                        <td>Customer Tokens - {{$total_tokens_for_customer_for_redeem}}</td>
                    </tr>
                </table>
                <hr>
                <table>
                    <h4>Items in Cart</h4>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Customer Tokens</th>
                            <th>Spl Discount</th>
                            <th>Sale Price</th>
                            <th>Qty. / Weight</th>
                            <th>GST</th>
                            <th>Sub-Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody  class="col-md-12">
                        
                        @if($carts)
                            
                            @foreach($carts as $cart)
                            <tr>
                                <td>{{ $cart->item_name }}</td>
                                <td>{{ $cart->customer_tokens }}</td>
                                <td>{{ $cart->discount }}</td>
                                <td>{{ $cart->price }}</td>
                                <td>{{ $cart->quantity }}{{ $cart->weight }}</td>
                                <td>{{ $cart->total_gst }}</td>
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
                                <b>Tokens issuing to Customer</b><br>
                                {{ $carts->sum('customer_tokens') }}
                            </td>
                            <td>
                                <b>Discount against Spl. Coupens</b><br>
                                {{ $carts->sum('discount') }}
                            </td>
                            <td>
                                <b>Total GST</b><br>
                                {{ $carts->sum('total_gst') }}
                            </td>
                            <td>
                                <b>Total Amount</b><br>
                                {{ $carts->sum('total') }}    
                            </td>
                            <td>
                                <b>Amount Payable</b><br>
                                {{ ceil($grand_total) }}
                            </td>
                            <td>
                                <div class="form-group">
                                    <b>Spl. Coupens realsing to {{ $customer->name }} for next purchase</b><br>
                                    {{ $spl_coupens }}
                                </div>
                            </td>
                        </tr>
                        <form wire:submit.prevent="savePayment">
                        <tr>
                            <td>
                                Applying Spl. coupens : {{$coupens_using}}
                             </td>
                            <td>        
                                Tokens Available to Redeem : {{ $total_tokens_for_purchase_to_redeem }}<br>
                            </td>
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
                    <a href="{{ route('sales.create') }}" class="btn btn-primary">Add more Items</a>
                </div>
            </div>
        </div>
    </div>
</div>
