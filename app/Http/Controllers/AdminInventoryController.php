<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;


use App\Models\Inventory;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\ProductVariation;
use App\Models\VendCart;


class AdminInventoryController extends Controller

{
    public function index()
    {
        $search = '';
        $from = '';
        $to = '';
        $productQuery = DB::table('inventories')
                ->select('inventories.*', 
                      'products.name as product_name', 
                      'products.description as product_description',
                      'products.type as product_type',
                      'product_categories.name as category_name', 
                      'product_subcategories.name as subcategory_name',
                      'product_variations.color as colour',
                      'product_variations.size as size',
                      'product_variations.weight as weight',
                      'product_variations.length as length',
                      'product_variations.liquid_volume as liquid',
                      'products.prod_pic as prod_pic',
                      )
                ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
                ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
                ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
                ->leftJoin('product_variations', 'products.variation_id', '=', 'product_variations.id');
                
        $inventories = $productQuery->get();
        return view('admin_inventories.index', compact('inventories', 'search', 'from', 'to'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $productQuery = DB::table('inventories')
                ->select('inventories.*', 
                      'products.name as product_name', 
                      'products.description as product_description',
                      'products.type as product_type',
                      'product_categories.name as category_name', 
                      'product_subcategories.name as subcategory_name',
                      'product_variations.color as colour',
                      'product_variations.size as size',
                      'product_variations.weight as weight',
                      'product_variations.length as length',
                      'product_variations.liquid_volume as liquid',
                      'products.prod_pic as prod_pic',
                      )
                ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
                ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
                ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
                ->leftJoin('product_variations', 'products.variation_id', '=', 'product_variations.id');
                
        $inventories = $productQuery->where('products.name', 'like', '%'.$search.'%')
                          ->orWhere('products.description', 'like', '%'.$search.'%')
                          ->orWhere('product_categories.name', 'like', '%'.$search.'%')
                          ->orWhere('product_subcategories.name', 'like', '%'.$search.'%')
                          ->orWhere('product_variations.color', 'like', '%'.$search.'%')
                          ->orWhere('product_variations.size', 'like', '%'.$search.'%')
                          ->orWhere('product_variations.weight', 'like', '%'.$search.'%')
                          ->orWhere('product_variations.length', 'like', '%'.$search.'%')
                          ->orWhere('product_variations.liquid_volume', 'like', '%'.$search.'%')->get();
        
        return view('admin_inventories.index', compact('inventories', 'search'));
    }

    public function dateSearch(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $productQuery = DB::table('inventories')
                ->select('inventories.*', 
                      'products.name as product_name', 
                      'products.description as product_description',
                      'products.type as product_type',
                      'product_categories.name as category_name', 
                      'product_subcategories.name as subcategory_name',
                      'product_variations.color as colour',
                      'product_variations.size as size',
                      'product_variations.weight as weight',
                      'product_variations.length as length',
                      'product_variations.liquid_volume as liquid',
                      'products.prod_pic as prod_pic',
                      )
                ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
                ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
                ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
                ->leftJoin('product_variations', 'products.variation_id', '=', 'product_variations.id');
                
        $inventories = $productQuery->whereBetween('inventories.updated_at', [$from, $to])->get();
        
        return view('admin_inventories.index', compact('inventories', 'from', 'to'));
    }

    public function addstock()
    {
        $productQuery = DB::table('products')
                ->select('products.*', 
                      'product_categories.name as category_name', 
                      'product_subcategories.name as subcategory_name',
                      'product_variations.color as colour',
                      'product_variations.size as size',
                      'product_variations.weight as weight',
                      'product_variations.length as length',
                      'product_variations.liquid_volume as liquid')
                ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
                ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
                ->leftJoin('product_variations', 'products.variation_id', '=', 'product_variations.id');
        $products = $productQuery->get();
            
        return view('admin_inventories.addstock', compact('products'));
    }

    public function searchProduct(Request $request)
    {
        $search = $request->get('search');
        $productQuery = DB::table('products')
                ->select('products.*', 
                      'product_categories.name as category_name', 
                      'product_subcategories.name as subcategory_name',
                      'product_variations.color as colour',
                      'product_variations.size as size',
                      'product_variations.weight as weight',
                      'product_variations.length as length',
                      'product_variations.liquid_volume as liquid')
                ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
                ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
                ->leftJoin('product_variations', 'products.variation_id', '=', 'product_variations.id');
        $products = $productQuery->where('products.name', 'like', '%'.$search.'%')
                          ->orWhere('products.description', 'like', '%'.$search.'%')
                          ->orWhere('product_categories.name', 'like', '%'.$search.'%')
                          ->orWhere('product_subcategories.name', 'like', '%'.$search.'%')
                          ->orWhere('product_variations.color', 'like', '%'.$search.'%')
                          ->orWhere('product_variations.size', 'like', '%'.$search.'%')
                          ->orWhere('product_variations.weight', 'like', '%'.$search.'%')
                          ->orWhere('product_variations.length', 'like', '%'.$search.'%')
                          ->orWhere('product_variations.liquid_volume', 'like', '%'.$search.'%')->get();
        
        return view('admin_inventories.create', compact('products'));
        
    }

    public function create()
    {
        $productQuery = DB::table('products')
                ->select('products.*', 
                      'product_categories.name as category_name', 
                      'product_subcategories.name as subcategory_name',
                      'product_variations.color as colour',
                      'product_variations.size as size',
                      'product_variations.weight as weight',
                      'product_variations.length as length',
                      'product_variations.liquid_volume as liquid')
                ->leftJoin('product_categories', 'products.category_id', '=', 'product_categories.id')
                ->leftJoin('product_subcategories', 'products.subcategory_id', '=', 'product_subcategories.id')
                ->leftJoin('product_variations', 'products.variation_id', '=', 'product_variations.id');
        $products = $productQuery->get();
        return view('admin_inventories.create', compact('products'));
    }

    public function addnewstock(Request $request)
    {
        $product = Product::find($request->product_id);
        return view('admin_inventories.addnewstock', compact('product'));   
    }
    public function store(Request $request)
    {
        $formdata = $request->validate([
            'qty' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'cost_price' => 'required|decimal:2',
            'mrp' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'batch_no' => 'nullable',
            'mfg_date' => 'nullable',
            'exp_date' => 'nullable',
            'remarks' => 'nullable',
        ]);

        $number = mt_rand(1000000000, 9999999999);

        if($this->productcodeExists($number)){
            $number = mt_rand(1000000000, 9999999999);
        }

        $request['product_code'] = $number;

        $product = Product::find($request->product_id);
        $profit = $request->sale_price - $request->cost_price;
        
        
        $inventory = new Inventory();
        $inventory->product_id = $request->product_id;
        $inventory->qty = $request->qty;
        $inventory->weight = $request->weight;
        $inventory->cost_price = $request->cost_price;
        $inventory->mrp = $request->mrp;
        $inventory->sale_price = $request->sale_price;
        $inventory->discount = $request->discount;
        $inventory->batch_no = $request->batch_no;
        $inventory->mfg_date = $request->mfg_date;
        $inventory->exp_date = $request->exp_date;
        $inventory->remarks = $request->remarks;
        $inventory->qr_code = $request->product_code;
        $inventory->user_id = Auth::user()->id;
        $inventory->save();
        
        return redirect()->route('admin_inventories.details', $inventory->id);

    }

    public function productcodeExists($number)
    {
        return Inventory::where('qr_code', $number)->exists();
    }

    public function details($id)
    {
        $inventory = Inventory::find($id);
        $product = Product::find($inventory->product_id);
        $productCategory = ProductCategory::find($product->category_id);
        $productSubcategory = ProductSubcategory::find($product->subcategory_id);
        $productVariation = ProductVariation::find($product->variation_id);
        return view('admin_inventories.details', compact('inventory', 'product', 'productCategory', 'productSubcategory', 'productVariation'));
    }

    public function edit($id)
    {
        $inventory = Inventory::find($id);
        return view('admin_inventories.edit', compact('inventory'));
    }

    public function update(Request $request, $id)
    {
        $inventory = Inventory::find($id);
        $inventory->product_id = $request->product_id;
        $inventory->quantity = $request->quantity;
        $inventory->save();

        return redirect()->route('admin_inventories.index');
    }

    public function destroy($id)
    {
        $inventory = Inventory::find($id);
        $inventory->delete();

        return redirect()->route('admin_inventories.index');
    }

    public function show($id)
    {
        $inventory = Inventory::find($id);
        return view('admin_inventories.show', compact('inventory'));
    }

}
