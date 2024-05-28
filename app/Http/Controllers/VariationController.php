<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();
        $variations = ProductVariation::all();
        $user = auth()->user();
        if ($user->user_role == '10') {
            return view('products.variations.create');
        } else if ($user->user_role == '1') {
            return view('admin_products.variations.create', compact('subcategories', 'categories', 'variations'));
        }
    }

    public function create()
    {
        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();
        $variations = ProductVariation::all();
        $user = auth()->user();
        if ($user->user_role == '10') {
            return view('products.variations.create', compact('subcategories', 'categories', 'variations'));
        } else if ($user->user_role == '1') {
            return view('admin_products.variations.create', compact('subcategories', 'categories', 'variations'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required',
            'color' => 'nullable',
            'size' => 'nullable',
            'weight' => 'nullable',
            'length' => 'nullable',
            'liquid_volume' => 'nullable',
        ]);

        ProductVariation::create($request->all());

        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();
        $variations = ProductVariation::all();
        $user = auth()->user();
        if ($user->user_role == '10') {
            return view('products.variations.create', compact('subcategories', 'categories', 'variations'));
        } else if ($user->user_role == '1') {
            return view('admin_products.variations.create', compact('subcategories', 'categories', 'variations'));
        }
    }

    

    public function destroy(ProductVariation $variation)
    {
        $variation->delete();

        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();
        $variations = ProductVariation::all();
        $user = auth()->user();
        if ($user->user_role == '10') {
            return view('products.variations.create', compact('subcategories', 'categories', 'variations'));
        } else if ($user->user_role == '1') {
            return view('admin_products.variations.create', compact('subcategories', 'categories', 'variations'));
        }
    }
}
