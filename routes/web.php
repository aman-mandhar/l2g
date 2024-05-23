<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorProductController;
use App\Http\Controllers\VendorSaleController;
use App\Http\Controllers\VendorOrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DayCloseController;
use App\Http\Controllers\AdminInventoryController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminSalesController;


use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/ecom1', function () {
    return view('ecom1');
});

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Auth::routes();

Route::prefix('admin')->middleware(['auth', 'isAdmins'])->group(function () 
    {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('index');
    });



Auth::routes();

Route::get('/index', [HomeController::class, 'index'])->name('index');
Route::get('/layouts/panels/vendor_panel/main', [HomeController::class, 'vendorDashboard'])->name('vendordashboard');
Route::get('/layouts/panels/admin_panel/main', [HomeController::class, 'adminDashboard'])->name('admindashboard');

// Register Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/getReferralName', [RegisterController::class, 'getReferralName']);

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout Routes
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// User Routes
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
Route::get('/getReferralName', [UserController::class, 'getReferralName']);
Route::get('/getReferralId', [UserController::class, 'getReferralId']);

// Categories
Route::get('/products/categories', [CategoryController::class, 'index'])->name('products.categories.index');
Route::get('/products/categories/create', [CategoryController::class, 'create'])->name('products.categories.create');
Route::get('/admin_products/categories/create', [CategoryController::class, 'create'])->name('admin_products.categories.create');
Route::post('/products/categories', [CategoryController::class, 'store'])->name('products.categories.store');
Route::get('/products/categories/{category}/edit', [CategoryController::class, 'edit'])->name('products.categories.edit');
Route::put('/products/categories/{category}', [CategoryController::class, 'update'])->name('products.categories.update');
Route::delete('/products/categories/{category}', [CategoryController::class, 'destroy'])->name('products.categories.destroy');
Route::get('/products/categories/search', [CategoryController::class, 'search'])->name('products.categories.search');

// Subcategories

Route::get('/products/subcategories/create', [SubcategoryController::class, 'create'])->name('products.subcategories.create');
Route::get('/admin_products/subcategories/create', [SubcategoryController::class, 'create'])->name('admin_products.subcategories.create');
Route::post('/products/subcategories', [SubcategoryController::class, 'store'])->name('products.subcategories.store');
Route::get('/products/subcategories/{subcategory}/edit', [SubcategoryController::class, 'edit'])->name('products.subcategories.edit');
Route::put('/products/subcategories{subcategory}', [SubcategoryController::class, 'update'])->name('products.subcategories.update');
Route::delete('/products/subcategories/{subcategory}', [SubcategoryController::class, 'destroy'])->name('products.subcategories.destroy');
Route::get('/products/subcategories/search', [SubcategoryController::class, 'search'])->name('products.subcategories.search');

// Variations
Route::get('/products/variations', [VariationController::class, 'index'])->name('products.variations.index');
Route::get('/products/variations/create', [VariationController::class, 'create'])->name('products.variations.create');
Route::get('/admin_products/variations/create', [VariationController::class, 'create'])->name('admin_products.variations.create');
Route::post('/products/variations', [VariationController::class, 'store'])->name('products.variations.store');
Route::get('/products/variations/{variation}/edit', [VariationController::class, 'edit'])->name('products.variations.edit');
Route::put('/products/variations/{variation}', [VariationController::class, 'update'])->name('products.variations.update');
Route::delete('/products/variations/{variation}', [VariationController::class, 'destroy'])->name('products.variations.destroy');

// order
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('orders/show/{id}', [OrderController::class, 'show'])->name('orders.show');

// Vendors
Route::get('/vendors', [VendorController::class, 'index'])->name('vendors.index');
Route::get('/vendors/create', [VendorController::class, 'create'])->name('vendors.create');
Route::post('/vendors/create_new', [VendorController::class, 'createnew'])->name('vendors.create_new');
Route::post('/vendors', [VendorController::class, 'store'])->name('vendors.store');
Route::get('/vendors/{vendor}', [VendorController::class, 'show'])->name('vendors.show');
Route::get('/vendors/{vendor}/edit', [VendorController::class, 'edit'])->name('vendors.edit');
Route::put('/vendors/{vendor}', [VendorController::class, 'update'])->name('vendors.update');
Route::delete('/vendors/{vendor}', [VendorController::class, 'destroy'])->name('vendors.destroy');
Route::get('/vendors/search', [VendorController::class, 'search'])->name('vendors.search');

// Vendor's Products
Route::get('/vendor_products', [VendorProductController::class, 'index'])->name('vendor_products.index');
Route::get('/vendor_products/create', [VendorProductController::class, 'create'])->name('vendor_products.create');
Route::post('/vendor_products', [VendorProductController::class, 'store'])->name('vendor_products.store');
Route::get('/vendor_products/{vendor_product}', [VendorProductController::class, 'show'])->name('vendor_products.show');
Route::get('/vendor_products/{vendor_product}/edit', [VendorProductController::class, 'edit'])->name('vendor_products.edit');
Route::put('/vendor_products/{vendor_product}', [VendorProductController::class, 'update'])->name('vendor_products.update');
Route::delete('/vendor_products/{vendor_product}', [VendorProductController::class, 'destroy'])->name('vendor_products.destroy');
Route::get('/vendor_products/search', [VendorProductController::class, 'search'])->name('vendor_products.search');

// Vendor's Products
Route::get('/admin_products', [AdminProductController::class, 'index'])->name('admin_products.index');
Route::get('/admin_products/create', [AdminProductController::class, 'create'])->name('admin_products.create');
Route::post('/admin_products', [AdminProductController::class, 'store'])->name('admin_products.store');
Route::get('/admin_products/{vendor_product}', [AdminProductController::class, 'show'])->name('admin_products.show');
Route::get('/admin_products/{vendor_product}/edit', [AdminProductController::class, 'edit'])->name('admin_products.edit');
Route::put('/admin_products/{vendor_product}', [AdminProductController::class, 'update'])->name('admin_products.update');
Route::delete('/admin_products/{vendor_product}', [AdminProductController::class, 'destroy'])->name('admin_products.destroy');
Route::get('/admin_products/search', [AdminProductController::class, 'search'])->name('admin_products.search');

// Inventory
Route::get('/inventories/addstock', [InventoryController::class, 'addstock'])->name('inventories.addstock');
Route::get('/inventories/searchProduct', [InventoryController::class, 'searchProduct'])->name('inventories.searchProduct');
Route::get('/inventories/details/{id}', [InventoryController::class, 'details'])->name('inventories.details');
Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories.index');
Route::get('/inventories/search', [InventoryController::class, 'search'])->name('inventories.search');
Route::get('/inventories/create', [InventoryController::class, 'create'])->name('inventories.create');
Route::get('/inventories/addnewstock', [InventoryController::class, 'addnewstock'])->name('inventories.addnewstock');
Route::post('/inventories', [InventoryController::class, 'store'])->name('inventories.store');
Route::get('/inventories/{inventory}/edit', [InventoryController::class, 'edit'])->name('inventories.edit');
Route::put('/inventories/{inventory}', [InventoryController::class, 'update'])->name('inventories.update');
Route::delete('/inventories/{inventory}', [InventoryController::class, 'destroy'])->name('inventories.destroy');

// Admin Inventories
Route::get('/admin_inventories/addstock', [AdminInventoryController::class, 'addstock'])->name('admin_inventories.addstock');
Route::get('/admin_inventories/searchProduct', [AdminInventoryController::class, 'searchProduct'])->name('admin_inventories.searchProduct');
Route::get('/admin_inventories/details/{id}', [AdminInventoryController::class, 'details'])->name('admin_inventories.details');
Route::get('/admin_inventories', [AdminInventoryController::class, 'index'])->name('admin_inventories.index');
Route::get('/admin_inventories/search', [AdminInventoryController::class, 'search'])->name('admin_inventories.search');
Route::get('/admin_inventories/create', [AdminInventoryController::class, 'create'])->name('admin_inventories.create');
Route::get('/admin_inventories/addnewstock', [AdminInventoryController::class, 'addnewstock'])->name('admin_inventories.addnewstock');
Route::post('/admin_inventories', [AdminInventoryController::class, 'store'])->name('admin_inventories.store');
Route::get('/admin_inventories/{inventory}/edit', [AdminInventoryController::class, 'edit'])->name('admin_inventories.edit');
Route::put('/admin_inventories/{inventory}', [AdminInventoryController::class, 'update'])->name('admin_inventories.update');
Route::delete('/admin_inventories/{inventory}', [AdminInventoryController::class, 'destroy'])->name('admin_inventories.destroy');


// Vendor_sales
Route::get('/vendor_sales', [VendorSaleController::class, 'index'])->name('vendor_sales.index');
Route::get('vendor_sales/check', [VendorSaleController::class, 'check'])->name('vendor_sales.check');
Route::get('/vendor_sales/usercheck', [VendorSaleController::class, 'usercheck'])->name('vendor_sales.usercheck');
Route::post('/vendor_sales/newuser', [VendorSaleController::class, 'newuser'])->name('vendor_sales.newuser');
Route::post('/vendor_sales/bill', [VendorSaleController::class, 'bill'])->name('vendor_sales.bill');
Route::get('/vendor_sales/create', [VendorSaleController::class, 'create'])->name('vendor_sales.create');
Route::get('/vendor_sales/new', [VendorSaleController::class, 'new'])->name('vendor_sales.new');
Route::get('/vendor_sales/searchproduct', [VendorSaleController::class, 'searchproduct'])->name('vendor_sales.searchproduct');
Route::post('/vendor_sales/addtocart', [VendorSaleController::class, 'addtocart'])->name('vendor_sales.addtocart');
Route::get('/vendor_sales/cart', [VendorSaleController::class, 'cart'])->name('vendor_sales.cart');
Route::get('/vendor_sales/quickuser', [VendorSaleController::class, 'quickuser'])->name('vendor_sales.quickuser');
Route::get('/vendor_sales/cart/remove/{id}', [VendorSaleController::class, 'removefromcart'])->name('vendor_sales.removefromcart');
Route::get('/vendor_sales/checkout', [VendorSaleController::class, 'checkout'])->name('vendor_sales.checkout');
Route::post('/vendor_sales/store', [VendorSaleController::class, 'store'])->name('vendor_sales.store');
Route::get('/vendor_sales/stock/{id}', [VendorSaleController::class, 'stock'])->name('vendor_sales.stock');

// Admin_sales
Route::get('/admin_sales', [AdminSalesController::class, 'index'])->name('admin_sales.index');
Route::get('admin_sales/check', [AdminSalesController::class, 'check'])->name('admin_sales.check');
Route::get('/admin_sales/usercheck', [AdminSalesController::class, 'usercheck'])->name('admin_sales.usercheck');
Route::post('/admin_sales/newuser', [AdminSalesController::class, 'newuser'])->name('admin_sales.newuser');
Route::post('/admin_sales/bill', [AdminSalesController::class, 'bill'])->name('admin_sales.bill');
Route::get('/admin_sales/create', [AdminSalesController::class, 'create'])->name('admin_sales.create');
Route::get('/admin_sales/new', [AdminSalesController::class, 'new'])->name('admin_sales.new');
Route::get('/admin_sales/searchproduct', [AdminSalesController::class, 'searchproduct'])->name('admin_sales.searchproduct');
Route::post('/admin_sales/addtocart', [AdminSalesController::class, 'addtocart'])->name('admin_sales.addtocart');
Route::get('/admin_sales/cart', [AdminSalesController::class, 'cart'])->name('admin_sales.cart');
Route::get('/admin_sales/quickuser', [AdminSalesController::class, 'quickuser'])->name('admin_sales.quickuser');
Route::get('/admin_sales/cart/remove/{id}', [AdminSalesController::class, 'removefromcart'])->name('admin_sales.removefromcart');
Route::get('/admin_sales/checkout', [AdminSalesController::class, 'checkout'])->name('admin_sales.checkout');
Route::post('/admin_sales/store', [AdminSalesController::class, 'store'])->name('admin_sales.store');
Route::get('/admin_sales/stock/{id}', [AdminSalesController::class, 'stock'])->name('admin_sales.stock');


// Vendor order
Route::get('/vendor_orders', [VendorOrderController::class, 'index'])->name('vendor_orders.index');
Route::get('/vendor_orders/show/{id}', [VendorOrderController::class, 'show'])->name('vendor_orders.show');

// Shop
Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');
Route::get('/shops/create', [ShopController::class, 'create'])->name('shops.create');
Route::post('/shops/create_new', [ShopController::class, 'createnew'])->name('shops.create_new');
Route::post('/shops', [ShopController::class, 'store'])->name('shops.store');
Route::get('/shops/{shop}', [ShopController::class, 'show'])->name('shops.show');
Route::get('/shops/{shop}/edit', [ShopController::class, 'edit'])->name('shops.edit');
Route::put('/shops/{shop}', [ShopController::class, 'update'])->name('shops.update');
Route::delete('/shops/{shop}', [ShopController::class, 'destroy'])->name('shops.destroy');
Route::get('/shops/search', [ShopController::class, 'search'])->name('shops.search');

// Day Close
Route::get('/dayclose', [DayCloseController::class, 'index'])->name('dayclose.index');
Route::get('/dayclose/search', [DayCloseController::class, 'search'])->name('dayclose.search');
Route::post('/dayclose/updateStatus', [DayCloseController::class, 'updateStatus'])->name('dayclose.update');





















