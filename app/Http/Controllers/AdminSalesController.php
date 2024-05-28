<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\ProductVariation;
use App\Models\User;
use App\Models\Order;
use App\Models\VendCart;
use App\Models\Vendor;

class AdminSalesController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin_sales.index', compact('orders'));
    }

    public function usercheck()
    {
        $mobile_number = null;
        $users = User::all();
        return view('admin_sales.usercheck', compact('users', 'mobile_number'));

    }

    public function check(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required|numeric|digits:10',
        ]);

        $mobile_number = $request->input('mobile_number');
        $customer = User::where('mobile_number', $mobile_number)->first();
        
        if($customer){
            $productQuery = DB::table('inventories')
                ->select('inventories.*', 
                'inventories.qr_code as qr_code',
                'products.name as product_name', 
                'products.gst as gst_rate',
                'products.type as type',
                'product_categories.name as category_name', 
                'product_subcategories.name as subcategory_name',
                'product_variations.color as Colour',
                'product_variations.size as Size',
                'product_variations.weight as v_weight',
                'product_variations.length as length',
                'product_variations.liquid_volume as liquid_volume')
                ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
                ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
                ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
                ->leftJoin('product_variations', 'products.variation_id', '=', 'product_variations.id');

                $prods = $productQuery->get();

                // flush the session
                Session()->forget('customer');
                Session()->forget('prods');

                // store the session
                Session::put('customer', $customer);
                Session::put('prods', $prods);

                return view('admin_sales.create', compact('prods', 'customer'));
        }else{
            $user = new User([
                'name' => "Tourist",
                'email' => "$mobile_number@highwayshop.in",
                'password' => Hash::make("12345678"),
                'mobile_number' => $mobile_number,
                'user_role' => "2",
                ]);
            $user->save();
            }
        $customer = User::where('mobile_number', $mobile_number)->first();
        $productQuery = DB::table('inventories')
                ->select('inventories.*', 
                'inventories.qr_code as qr_code',
                'products.name as product_name', 
                'products.gst as gst_rate',
                'products.type as type',
                'product_categories.name as category_name', 
                'product_subcategories.name as subcategory_name',
                'product_variations.color as Colour',
                'product_variations.size as Size',
                'product_variations.weight as v_weight',
                'product_variations.length as length',
                'product_variations.liquid_volume as liquid_volume')
                ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
                ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
                ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
                ->leftJoin('product_variations', 'products.variation_id', '=', 'product_variations.id');

        $prods = $productQuery->get();

                // flush the session
                Session()->forget('customer');
                Session()->forget('prods');

                // store the session
                Session::put('customer', $customer);
                Session::put('prods', $prods);

        return redirect()->route('admin_sales.create', compact('prods', 'customer'))->with('success', 'User created successfully');
}

    public function create()
    {
        $customer = Session::get('customer');
        $prods = Session::get('prods');
        return view('admin_sales.create', compact('prods', 'customer'));
    }

    public function searchproduct(Request $request)
    {
        $search = $request->input('search');
        $customer = Session::get('customer');
        $productQuery = DB::table('inventories')
                ->select('inventories.*', 
                'inventories.qr_code as qr_code',
                'products.name as product_name', 
                'products.gst as gst_rate',
                'products.type as type',
                'product_categories.name as category_name', 
                'product_subcategories.name as subcategory_name',
                'product_variations.color as Colour',
                'product_variations.size as Size',
                'product_variations.weight as v_weight',
                'product_variations.length as length',
                'product_variations.liquid_volume as liquid_volume')
                ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
                ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
                ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
                ->leftJoin('product_variations', 'products.variation_id', '=', 'product_variations.id')
                ->where('products.name', 'like', '%'.$search.'%');

                $prods = $productQuery->get();
        return view('admin_sales.create', compact('prods', 'customer'));
    }

    public function addtocart(Request $request)
{
    // Validate the request
    $request->validate([
        'customer_id' => 'required|exists:users,id',
        'user_id' => 'required|exists:users,id',
        'inventory_id' => 'required|exists:inventories,id',
        'product_name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'quantity' => 'nullable|numeric',
        'weight' => 'nullable|numeric',
        'discount' => 'nullable|numeric',
        'gst_rate' => 'required|numeric',
    ]);

    // User must be logged in
    $user = Auth::user();
    if (!$user) {
        return redirect()->back()->with('error', 'User must be logged in.');
    }

    // Calculate the total and tokens
    $price = $request->price;
    $quantity = $request->quantity ?? null;
    $weight = $request->weight ?? null;

    if ($quantity) {
        $total = $price * $quantity;
    } else if ($weight) {
        $total = $price * $weight;
    } else {
        return redirect()->back()->with('error', 'Either quantity or weight must be provided.');
    }

    $total_gst = ($total - $request->discount) * $request->gst_rate / 100;

    // Get session data
    $customer = Session::get('customer');
    $prods = Session::get('prods');

    // Check if the product is already in the cart
    $existingCartItem = VendCart::where('customer_id', $request->customer_id)
        ->where('user_id', $user->id)
        ->where('inventory_id', $request->inventory_id)
        ->whereNull('order_id')
        ->whereNull('deleted_at')
        ->first();

    if ($existingCartItem) {
        return redirect()->back()->with('error', 'Product already in cart.');
    }

    // Check inventory availability
    $inventory = Inventory::find($request->inventory_id);
    if (!$inventory) {
        return redirect()->back()->with('error', 'Inventory item not found.');
    }

    $quantity_available = $inventory->qty - VendCart::where('inventory_id', $request->inventory_id)->whereNotNull('order_id')->sum('quantity');
    $weight_available = $inventory->weight - VendCart::where('inventory_id', $request->inventory_id)->whereNotNull('order_id')->sum('weight');

    if (($quantity && $quantity > $quantity_available) || ($weight && $weight > $weight_available)) {
        return redirect()->back()->with('error', 'Quantity or weight not available.');
    }

    // Add item to the cart
    $vendor_cart = new VendCart();
    $vendor_cart->customer_id = $request->customer_id;
    $vendor_cart->user_id = Auth::user()->id;
    $vendor_cart->inventory_id = $request->inventory_id;
    $vendor_cart->product_name = $request->product_name;
    $vendor_cart->quantity = $quantity;
    $vendor_cart->weight = $weight;
    $vendor_cart->price = $price;
    $vendor_cart->total = $total;
    $vendor_cart->total_gst = $total_gst;
    $vendor_cart->discount = $request->discount;
    $vendor_cart->save();

    return view('admin_sales.create', compact('prods', 'customer'));
}

    public function cart()
    {
        $customer = Session::get('customer');
        $prods = Session::get('prods');
        $vendor_cart = VendCart::where('customer_id', $customer->id)
                        ->whereNull('order_id')->get();
        return view('admin_sales.cart', compact('vendor_cart', 'customer', 'prods'));
    }
    
    public function removefromcart($id)
    {
        $vendor_cart = VendCart::where('id', $id)->first();
        $vendor_cart->delete();
        $customer = Session::get('customer');
        $ref = Session::get('ref');
        $prods = Session::get('prods');
        return view('admin_sales.create', compact('prods', 'customer', 'ref'));
    }

    public function checkout()
    {
        $customer = Session::get('customer');
        $ref = Session::get('ref');
        $prods = Session::get('prods');
        $vendor_cart = VendCart::where('customer_id', $customer->id)
                        ->where('user_id', Auth::user()->id)
                        ->whereNull('deleted_at')
                        ->whereNull('order_id')->get();
        return view('admin_sales.checkout', compact('vendor_cart', 'customer', 'ref', 'prods'));
    }
}
