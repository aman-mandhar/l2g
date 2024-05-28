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
       <h4>Admin</h4>
       <ul class="list-unstyled components">
          <li class="active">
             <a href="{{ route('admindashboard') }}"><i class="fa fa-dashboard yellow_color"></i> <span>Dashboard</span></a>
          </li>
          <li>
             <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-diamond purple_color"></i> <span>Sale Orders</span></a>
             <ul class="collapse list-unstyled" id="element">
                <li><a href="{{ route('admin_sales.index') }}">> <span>List of Sale Orders</span></a></li>
                <li><a href="{{ route('admin_sales.usercheck') }}">> <span>New Product Sale</span></a></li>
             </ul>
          </li>
          <li>
             <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-object-group blue2_color"></i> <span>Products</span></a>
             <ul class="collapse list-unstyled" id="apps">
               <li><a href="{{ route('admin_products.index')}}">> <span>All Products List</span></a></li>
                <li><a href="{{ route('admin_products.create') }}">> <span>Create Product</span></a></li>
                <li><a href="{{ route('admin_products.categories.create') }}">> <span>New Category</span></a></li>
                <li><a href="{{ route('admin_products.subcategories.create') }}">> <span>New Sub-Category</span></a></li>
                <li><a href="{{ route('admin_products.variations.create') }}">> <span>New Variation</span></a></li>
             </ul>
          </li>
          <li class="active">
             <a href="#additional_page" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-clone yellow_color"></i> <span>Stock</span></a>
             <ul class="collapse list-unstyled" id="additional_page">
               <li>
                  <a href="{{ route('admin_inventories.addstock') }}">> <span>Add Stock</span></a>
               </li>
                <li>
                   <a href="{{ route('admin_inventories.index') }}">> <span>All Stock List</span></a>
                </li>
             </ul>
          </li>
          <li class="active">
            <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-user yellow_color"></i> <span>Users</span></a>
            <ul class="collapse list-unstyled" id="users">
               <li>
                  <a href="{{ route('users.index') }}">> <span>All Users</span></a>
               </li>
               <li>
                  <a href="{{ route('vendors.create') }}">> <span>New Vendor</span></a>
               </li>
               <li>
                  <a href="{{ route('shops.create') }}">> <span>New Shop</span></a>
               </li>
            </ul>
         </li>
          <li><a href="{{ route('dayclose.index')}}"><i class="fa fa-bar-chart-o green_color"></i> <span>Day Report</span></a></li>
      </ul>
    </div>
 </nav>
 <!-- end sidebar -->