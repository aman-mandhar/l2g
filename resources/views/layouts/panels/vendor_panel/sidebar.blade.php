
<!-- Sidebar  -->
<nav id="sidebar">
    <div class="sidebar_blog_1">
       <div class="sidebar-header">
          <div class="logo_section">
             <a href="index.html"><img class="logo_icon img-responsive" src="{{ asset('ecom/images/logo.png') }}" alt="#" /></a>
          </div>
       </div>
       <div class="sidebar_user_info">
          <div class="icon_setting"></div>
          <div class="user_profle_side">
             <div class="user_info">
                <h6>{{ Auth::user()->name }}</h6>
                <p><span class="online_animation"></span> Online</p>
                @if (Auth::check())
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                  </form>
                @else
                  <a href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif
             </div>
          </div>
       </div>
    </div>
    <div class="sidebar_blog_2">
       <h4>Vendor</h4>
       <ul class="list-unstyled components">
          <li class="active">
             <a href="{{ route('vendordashboard') }}"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a>
          </li>
          <li>
             <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-diamond purple_color"></i> <span>Sale Orders</span></a>
             <ul class="collapse list-unstyled" id="element">
                <li><a href="{{ route('vendor_orders.index') }}">> <span>All Sale Orders</span></a></li>
                <li><a href="{{ route('vendor_sales.usercheck') }}">> <span>New Sale</span></a></li>
             </ul>
          </li>
          <li>
             <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-object-group blue2_color"></i> <span>Products</span></a>
             <ul class="collapse list-unstyled" id="apps">
               <li><a href="{{ route('vendor_products.index')}}">> <span>All Products</span></a></li>
                <li><a href="{{ route('vendor_products.create') }}">> <span>New Product</span></a></li>
                <li><a href="{{ route('products.categories.create') }}">> <span>New Category</span></a></li>
                <li><a href="{{ route('products.subcategories.create') }}">> <span>New Subcategory</span></a></li>
                <li><a href="{{ route('products.variations.create') }}">> <span>New Variant</span></a></li>
             </ul>
          </li>
          <li class="active">
             <a href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-bar-chart-o green_color"></i> <span>Stock</span></a>
             <ul class="collapse list-unstyled" id="additional_page">
               <li>
                  <a href="{{ route('inventories.addstock') }}">> <span>Add New Stock</span></a>
               </li>
                <li>
                   <a href="{{ route('inventories.index') }}">> <span>Stock List</span></a>
                </li>
             </ul>
          </li>
       </ul>
    </div>
 </nav>
 <!-- end sidebar -->
