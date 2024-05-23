
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link normal-navigation" href="{{ '/admin/dashboard' }}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item">
        <a href=""  class="nav-link normal-navigation">
          <i class="mdi mdi-circle-outline menu-icon"></i>
          <h5>New Sale</h5>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#auth">
            <i class="mdi mdi-circle-outline menu-icon"></i>
            <span class="menu-title">Tokens Distribution</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('tokens.index') }}"> List of Token System </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('tokens.create') }}"> Add New System </a></li>
                
            </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#auth">
            <i class="mdi mdi-circle-outline menu-icon"></i>
            <span class="menu-title">Products</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('products.categories.create') }}"> Add Category</a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('products.subcategories.create') }}"> Add Sub-Category</a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('products.variations.create') }}"> Add Variations</a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('products.items.create') }}"> Add Item</a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('products.items.index')}}"> Item List </a></li>
            </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#auth">
            <i class="mdi mdi-circle-outline menu-icon"></i>
            <span class="menu-title">Stocks</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('stocks.index') }}"> Stock List </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('products.items.index') }}"> Add New Stock </a></li>
            </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#auth">
            <i class="mdi mdi-circle-outline menu-icon"></i>
            <span class="menu-title">Warehouse</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('warehouses.index') }}"> Warehouse List </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('warehouses.create') }}"> Add New Warehouse </a></li>
            </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#auth">
            <i class="mdi mdi-circle-outline menu-icon"></i>
            <span class="menu-title">Sub-Warehouse</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('subwarehouses.index') }}"> Sub-Warehouse List </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('subwarehouses.create') }}"> Add New Sub-Warehouse </a></li>
            </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#auth">
            <i class="mdi mdi-circle-outline menu-icon"></i>
            <span class="menu-title">Retail Stores</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('retails.index') }}"> Store List </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('retails.create') }}"> Add New Store </a></li>
            </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#auth">
            <i class="mdi mdi-circle-outline menu-icon"></i>
            <span class="menu-title">Merchants</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('retails.index') }}"> Merchant List </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('retails.index') }}"> Add New Merchant </a></li>
            </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#auth">
            <i class="mdi mdi-circle-outline menu-icon"></i>
            <span class="menu-title">Employee</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('retails.index') }}"> Employee List </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('retails.index') }}"> Add New Employee </a></li>
            </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#auth">
            <i class="mdi mdi-circle-outline menu-icon"></i>
            <span class="menu-title">Transporter</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('retails.index') }}"> Transporter List </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('retails.index') }}"> Add New Transporter </a></li>
            </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#auth">
            <i class="mdi mdi-circle-outline menu-icon"></i>
            <span class="menu-title">Delivery Partner</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('retails.index') }}"> Delivery Partner List </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('retails.index') }}"> Add New Delivery Partner </a></li>
            </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#auth">
            <i class="mdi mdi-circle-outline menu-icon"></i>
            <span class="menu-title">Business Promoter</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('bps.index') }}"> Business Promoter List </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('bps.create') }}"> Add New Business Promoter </a></li>
            </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#auth">
            <i class="mdi mdi-account menu-icon"></i>
            <span class="menu-title">Users</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('users.create') }}"> Add New </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('users.index') }}"> List </a></li>
            </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#auth">
            <i class="mdi mdi-circle-outline menu-icon"></i>
            <span class="menu-title">Reward Points</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
            <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('wallets.index')}}"> Referral Points </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('wallets.index')}}"> Customer Points </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('wallets.index')}}"> Business Points </a></li>
                <li class="nav-item"> <a class="nav-link normal-navigation" href="{{ route('wallets.index')}}"> Adjust </a></li>
            </ul>
        </div>
      </li>
    </ul>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
    $('.nav-link.normal-navigation').on('click', function () {
        // Continue with normal navigation for links with the class 'normal-navigation'
        return;
    });

    $('.nav-link').not('.normal-navigation').on('click', function (e) {
        // Prevent the default behavior of the link for other links
        e.preventDefault();

        // Toggle the collapse state of the submenu with sliding animation
        $(this).next('.collapse').slideToggle();
        // Toggle the arrow icon class
        $(this).find('.menu-arrow').toggleClass('menu-arrow-reverse');
    });
});


    </script>
    </nav>