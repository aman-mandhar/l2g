<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\ProductVariation;
use App\Models\Inventory;
use App\Models\User;

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

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin_products.index', ['products' => $products]);
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $vendorProducts = Product::where('name', 'like', '%'.$search.'%')->get();

        return view('admin_products.index', ['vendorProducts' => $vendorProducts]);
    }


    public function showAllData()
    {
        // Fetch all categories with their subcategories and variations
        $vendorProducts = Product::with('categories.subcategories.variations')->get();

        return view('admin_products.all', compact('vendorProducts'));
    }

    public function show($id)
    {
        $vendorProduct = Product::find($id);

        return view('admin_products.show', ['vendorProduct' => $vendorProduct]);
    }

    public function getSubcategories($category)
    {
        $subcategories = ProductSubcategory::where('category_id', $category)->get();

        $options = '<option value="">Select Sub-Category</option>';
        foreach ($subcategories as $subcategory) {
            $options .= '<option value="' . $subcategory->id . '">' . $subcategory->name . '</option>';
        }

        return $options;
    }

    public function getVariations($subcategory)
    {
        $variations = ProductVariation::where('subcategory_id', $subcategory)->get();

        $options = '<option value="">Select Variation</option>';
        foreach ($variations as $variation) {
        $options .= '<option value="' . $variation->id . '">' . $variation->color . ' ' . $variation->size . ' ' . $variation->weight . ' ' . $variation->length . ' ' . $variation->liquid_volume . '</option>';
    }
    
        return $options;
    }

    public function create()
    {
        return view('admin_products.create');
    }
}
