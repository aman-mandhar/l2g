
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link normal-navigation" href="{{ '/admin/dashboard' }}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Retailer Dashboard</span>
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