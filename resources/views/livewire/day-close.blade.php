<div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form method="GET" wire:submit.prevent="search">
        @csrf
        <div class="form-group">
            <label for="user_id">Vendor</label>
            <select class="form-control" id="user_id" name="user_id">
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor->user_id }}">{{ $vendor->vendor_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <div class="white_shd full margin_bottom_30">
        <div class="full graph_head">
            <div class="heading1 margin_0">
                <h5>Revenue Detail</h5>
            </div>
        </div>
        <div class="table_section padding_infor_info">
            <div class="table-responsive-sm">
                <form wire:submit.prevent="updateStatus">
                    @csrf
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th><input type="checkbox" wire:model="selectAll"></th>
                                <th>Name</th>
                                <th>Order id</th>
                                <th>Cash</th>
                                <th>Card</th>
                                <th>UPI</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td><input type="checkbox" wire:model="selectedOrders" value="{{ $order->id }}"></td>
                                <td>{{ $order->vendor_name }}</td>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->cash }}</td>
                                <td>{{ $order->card }}</td>
                                <td>{{ $order->upi }}</td>
                                <td>{{ $order->cash + $order->card + $order->upi }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td><input type="checkbox" wire:model="selectAll"></td>
                                <td>Total</td>
                                <td>{{ $total_orders }}</td>
                                <td>{{ $total_cash }}</td>
                                <td>{{ $total_card }}</td>
                                <td>{{ $total_upi }}</td>
                                <td>{{ $total_amt }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <tr>
                        <td colspan="7">
                            <button type="submit" class="btn btn-success">Day Close</button>
                        </td>
                        <td>
                            <a href="{{ route('dayclose.index') }}" class="btn btn-danger">Reset</a>
                        </td>
                    </tr>
                    
                </form>
            </div>
        </div>
    </div>
</div>
