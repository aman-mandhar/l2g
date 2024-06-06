<div class="midde_cont">
    <div class="container-fluid">
        <!--Title-->
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <h2>Dashboard</h2>
                </div>
            </div>
        </div>
      
        <!--Sale Search as per updated_at -->
        <div class="col-md-6">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph">
                    <div class="heading1 margin_0">
                        <h2>Search Sale</h2>
                    </div>
                    <div class="table_section padding_infor_info">
                        <div class="table-responsive-sm">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>From Date</th>
                                        <th>To Date</th>
                                        <th>Search</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form method="GET" wire:submit.prevent="searchSale">
                                        <tr>
                                            <td>
                                                <input type="date" class="form-control" wire:model="from_date">
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" wire:model="to_date">
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" type="submit">Search</button>
                                            </td>
                                        </tr>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     
        <!-- table section -->
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2>Sales Report</h2>
                    </div>
                </div>
                <div class="table_section padding_infor_info">
                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Cost</th>
                                    <th>Price</th>
                                    <th>Profit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($soldOuts as $soldOut) 
                                <tr>
                                    <td>{{ $soldOut->name }}</td>
                                    <td>{{ $soldOut->qty }}</td>
                                    <td>{{ $soldOut->cost * $soldOut->qty }}</td>
                                    <td>{{ $soldOut->price * $soldOut->qty }}</td>
                                    <td>{{ ($soldOut->price * $soldOut->qty) - ($soldOut->cost * $soldOut->qty) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $soldOuts->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Totals section -->
        <div class="col-md-12">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2>Totals</h2>
                    </div>
                </div>
                <div class="table_section padding_infor_info">
                    <div class="table-responsive-sm">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><strong>Total Cost:</strong> {{ $totalCost }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Price:</strong> {{ $totalPrice }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Profit:</strong> {{ $totalProfit }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
