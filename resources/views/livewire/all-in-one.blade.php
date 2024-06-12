<div class="midde_cont">
    <div class="container-fluid">
       <div class="row column_title">
          <div class="col-md-12">
             <div class="page_title">
                <h2>Dashboard</h2>
             </div>
          </div>
       </div>
      <!-- row -->
       <div class="col-md-6">
         <h4>Sale Report</h4>
      </div>
       <div class="row">
       <!-- table section -->
         
          <div class="col-md-6">
             <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                   <div class="heading1 margin_0">
                      <h2>Vendor's Running Sale</h2>
                   </div>
                </div>
                <div class="table_section padding_infor_info">
                   <div class="table-responsive-sm">
                      <table class="table">
                         <thead>
                            <tr>
                               <th>Orders <br>{{ $today_orders }}</th>
                               <th>Total <br>{{ $today_amount }} </th>
                               <th>Cash <br>{{ $today_cash }} </th>
                               <th>Card <br>{{ $today_card }} </th>
                               <th>Upi <br>{{ $today_upi }} </th>
                            </tr>
                         </thead>
                         <tbody>
                           @if($orders != null)
                           
                              @foreach($orders as $order)
                           <tr>
                              <td>{{ $order->id}}</td>
                               <td>{{ $order->amount}}</td>
                               <td>{{ $order->cash}}</td>
                               <td>{{ $order->card}}</td>
                               <td>{{ $order->upi}}</td>
                            </tr>
                              @endforeach
                           
                           @else
                           <tr>
                              <td>0</td>
                               <td>0</td>
                               <td>0</td>
                               <td>0</td>
                               <td>0</td>
                            </tr>
                           
                           @endif
                           
                         </tbody>
                      </table>
                   </div>
                </div>
             </div>
          </div>
          <!-- table section -->
          <div class="col-md-6">
            <div class="white_shd full margin_bottom_30">
               <div class="full graph_head">
                  <div class="heading1 margin_0">
                     <h2>Total Sale made by vendor</h2>
                  </div>
               </div>
               <div class="table_section padding_infor_info">
                  <div class="table-responsive-sm">
                     <table class="table">
                        <thead>
                           <tr>
                              <th>Orders <br>{{ $total_orders }}</th>
                              <th>Total <br>{{ $total_amount }} </th>
                              <th>Cash <br>{{ $total_cash }} </th>
                              <th>Card <br>{{ $total_card }} </th>
                              <th>Upi <br>{{ $total_upi }} </th>
                           </tr>
                        </thead>
                        <tbody>
                          @foreach($allProducts as $allProduct) 
                          <tr>
                              <td>{{ $allProduct->id}}</td>
                              <td>{{ $allProduct->amount}}</td>
                              <td>{{ $allProduct->cash}}</td>
                              <td>{{ $allProduct->card}}</td>
                              <td>{{ $allProduct->upi}}</td>
                           </tr>
                          @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         
          <div class="col-md-12">
             <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                   <div class="heading1 margin_0">
                      <h2>Stock List</h2>
                   </div>
                </div>
                <div class="table_section padding_infor_info">
                  <div class="table-responsive-sm">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>Name</th>
                                  <th>Category</th>
                                  <th>Sub-Category</th>
                                  <th>Variations</th>
                                  <th>Stock</th>
                                  <th>MRP</th>
                                  <th>Sale Price</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($stocks as $stock) 
                              @php
                                  $item = App\Models\Inventory::findOrFail($stock->id);
                                  $qty_in_stock = $item->qty;
                                  $weight_in_stock = $item->weight;
                                  $sold_qty = App\Models\VendCart::where('inventory_id', $stock->id)
                                                                  ->where('order_id', '!=', null)
                                                                  ->sum('quantity');
                                  $sold_weight = App\Models\VendCart::where('inventory_id', $stock->id)
                                                                    ->where('order_id', '!=', null)
                                                                    ->sum('weight');
                                  $qty = $qty_in_stock - $sold_qty;
                                  $weight = $weight_in_stock - $sold_weight;
                              @endphp
                              @if(($stock->type == '1' && $qty == 0) || ($stock->type != '1' && $weight == 0))
                                  @continue
                              @endif
                              <tr>
                                  <td>{{ $stock->product_name }}</td>
                                  <td>{{ $stock->category_name }}</td>
                                  <td>{{ $stock->subcategory_name }}</td>
                                  <td>
                                      @if($stock->colour)
                                          Colour - {{ $stock->colour }}
                                      @elseif($stock->size)
                                          Size - {{ $stock->size }}
                                      @elseif($stock->weight)
                                          Weight - {{ $stock->weight }}
                                      @elseif($stock->length)
                                          Length - {{ $stock->length }}
                                      @elseif($stock->liquid)
                                          Liquid - {{ $stock->liquid }}
                                      @endif
                                  </td>
                                  <td>
                                      @if($stock->type == '1')
                                          {{ $qty }}
                                      @else
                                          {{ $weight }}
                                      @endif
                                  </td>
                                  <td>{{ $stock->mrp }}</td>
                                  <td>{{ $stock->price }}</td>
                              </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
                  <button class="btn btn-primary" onclick="window.print()">Print</button>
              </div>
             </div>
          </div>
       </div>
    </div>
