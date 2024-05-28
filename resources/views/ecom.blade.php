@extends('layouts.online.frontlayout')
@section('content')
   
         <!--banner section start -->
         <div class="banner_section layout_padding">
            <div id="my_slider" class="carousel slide" data-ride="carousel">
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="container">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="taital_main">
                                 <h4 class="banner_taital"><span class="font_size_90">100%</span> Make in India</h4>
                                 <p class="banner_text">Ready to use for Small & Medium Retailer</p>
                                 <div class="book_bt"><a href="#">Shop Now</a></div>
                              </div>
                           </div>
                           <div class="col-md-6">
                                <div><img src="{{ asset('ecom/images/img-1.png') }}" class="image_1"></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="container">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="taital_main">
                                <h4 class="banner_taital"><span class="font_size_90">100%</span> Make in India</h4>
                                <p class="banner_text">Ready to use for Small & Medium Retailer</p>
                                <div class="book_bt"><a href="#">Shop Now</a></div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div><img src="{{ asset('online/img/featured/feature-1.png') }}" class="image_1"></div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="container">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="taital_main">
                                <h4 class="banner_taital"><span class="font_size_90">100%</span> Make in India</h4>
                                <p class="banner_text">Ready to use for Small & Medium Retailer</p>
                                <div class="book_bt"><a href="#">Shop Now</a></div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div><img src="{{ asset('online/img/featured/feature-2.png') }}" class="image_1"></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <a class="carousel-control-prev" href="#my_slider" role="button" data-slide="prev">
               <i class=""><img src="{{ asset('ecom/images/left-icon.png') }}"></i>
               </a>
               <a class="carousel-control-next" href="#my_slider" role="button" data-slide="next">
               <i class=""><img src="{{ asset('ecom/images/right-icon.png') }}"></i>
               </a>
            </div>
         </div>
         <!--banner section end -->
      </div>
      <!--header section end -->

    
  
@endsection
      
   

