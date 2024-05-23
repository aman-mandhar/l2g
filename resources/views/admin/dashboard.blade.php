@extends('layouts.panels.admin_panel.dashboard')

@section('content')

@include('layouts.panels.admin_panel.navbar')
<div class="midde_cont">
    <div class="container-fluid">
       <div class="row column_title">
          <div class="col-md-12">
             <div class="page_title">
                <h2>Dashboard</h2>
             </div>
          </div>
       </div>

       <div class="row column1">
          <div class="col-md-6 col-lg-3">
             <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                   <div> 
                      <i class="fa fa-user yellow_color"></i>
                   </div>
                </div>
                <div class="counter_no">
                   <div>
                      <p class="total_no">2500</p>
                      <p class="head_couter">Total Refferals</p>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-md-6 col-lg-3">
             <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                   <div> 
                      <i class="fa fa-clock-o blue1_color"></i>
                   </div>
                </div>
                <div class="counter_no">
                   <div>
                      <p class="total_no">123.50</p>
                      <p class="head_couter">Spl. Discount Coupens</p>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-md-6 col-lg-3">
             <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                   <div> 
                      <i class="fa fa-cloud-download green_color"></i>
                   </div>
                </div>
                <div class="counter_no">
                   <div>
                      <p class="total_no">1,805</p>
                      <p class="head_couter">Redeemable Tokens</p>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-md-6 col-lg-3">
             <div class="full counter_section margin_bottom_30">
                <div class="couter_icon">
                   <div> 
                      <i class="fa fa-comments-o red_color"></i>
                   </div>
                </div>
                <div class="counter_no">
                   <div>
                      <p class="total_no">54</p>
                      <p class="head_couter">Activity Tokens</p>
                   </div>
                </div>
             </div>
          </div>
       </div>
         <!-- Packages -->
       
            
            <!-- row -->
            <div class="row column1">
               <div class="col-md-12">
                  <div class="white_shd full margin_bottom_30">
                     <div class="full graph_head">
                        <div class="heading1 margin_0">
                           <h2>Packages</h2>
                        </div>
                     </div>
                     <div class="full price_table padding_infor_info">
                        <div class="row">
                           <!-- column price --> 
                           <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                              <div class="table_price full">
                                 <div class="inner_table_price">
                                    <div class="price_table_head blue1_bg">
                                       <h2>Standard</h2>
                                    </div>
                                    <div class="price_table_inner">
                                       <div class="cont_table_price_blog">
                                          <p class="blue1_color">Rs. <span class="price_no">1000</span></p>
                                       </div>
                                       <div class="cont_table_price">
                                          <ul>
                                             <li><a href="#">Rs. 700 Spl. Coupens</a></li>
                                             <li><a href="#">1 Activity Token</a></li>
                                             <li><a href="#">2 free deliveries</a></li>
                                             <li><a href="#">More</a></li>
                                          </ul>
                                       </div>
                                    </div>
                                    <div class="price_table_bottom">
                                       <div class="center"><a class="main_bt" href="#">Buy Now</a></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- end column price -->
                           <!-- column price --> 
                           <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                              <div class="table_price full">
                                 <div class="inner_table_price">
                                    <div class="price_table_head green_bg">
                                       <h2>Silver</h2>
                                    </div>
                                    <div class="price_table_inner">
                                       <div class="cont_table_price_blog">
                                          <p class="green_color">Rs. <span class="price_no">4000</span></p>
                                       </div>
                                       <div class="cont_table_price">
                                          <ul>
                                             <li><a href="#">Rs. 3000 Spl. Coupens</a></li>
                                             <li><a href="#">5 Activity Token</a></li>
                                             <li><a href="#">10 free deliveries</a></li>
                                             <li><a href="#">More</a></li>
                                          </ul>
                                       </div>
                                    </div>
                                    <div class="price_table_bottom">
                                       <div class="center"><a class="main_bt" href="#">Buy Now</a></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- end column price -->
                           <!-- column price --> 
                           <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                              <div class="table_price full">
                                 <div class="inner_table_price">
                                    <div class="price_table_head red_bg">
                                       <h2>Golden</h2>
                                    </div>
                                    <div class="price_table_inner">
                                       <div class="cont_table_price_blog">
                                          <p class="red_color">Rs. <span class="price_no">7500</span></p>
                                       </div>
                                       <div class="cont_table_price">
                                          <ul>
                                             <li><a href="#">Rs. 6500 Spl. Coupens</a></li>
                                             <li><a href="#">10 Activity Token</a></li>
                                             <li><a href="#">20 free deliveries</a></li>
                                             <li><a href="#">More</a></li>
                                          </ul>
                                       </div>
                                    </div>
                                    <div class="price_table_bottom">
                                       <div class="center"><a class="main_bt" href="#">Buy Now</a></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- end column price -->
                           <!-- column price --> 
                           <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                              <div class="table_price full">
                                 <div class="inner_table_price">
                                    <div class="price_table_head yellow_bg">
                                       <h2>Pletinum</h2>
                                    </div>
                                    <div class="price_table_inner">
                                       <div class="cont_table_price_blog">
                                          <p class="yellow_color">Rs. <span class="price_no">10000</span></p>
                                       </div>
                                       <div class="cont_table_price">
                                          <ul>
                                             <li><a href="#">Rs. 8800 Spl. Coupens</a></li>
                                             <li><a href="#">13 Activity Token</a></li>
                                             <li><a href="#">30 free deliveries</a></li>
                                             <li><a href="#">More</a></li>
                                          </ul>
                                       </div>
                                    </div>
                                    <div class="price_table_bottom">
                                       <div class="center"><a class="main_bt" href="#">Buy Now</a></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- end column price -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end row -->
         </div>
         <div class="row column1">
            <div class="col-md-12">
               <div class="white_shd full margin_bottom_30">
                  @livewire('token-balance')
               </div>
               <div class="white_shd full margin_bottom_30">
                  @livewire('ref-detail')
               </div>
               <div class="white_shd full margin_bottom_30">
                  
                           <a href="{{ route('redeem.create') }}"><p class="head_couter green_color">Redeem Tokens</p></a>
               
               </div>
               <div class="white_shd full margin_bottom_30">

                           <a href="{{ route('sales.quickuser') }}"><p class="head_couter blue1_color">Create New Refferal</p></a>
                        
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
