<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\ProductVariation;
use Illuminate\Http\Request;

class VariationController extends Controller
{
    public function index()
    {
        $variations = ProductVariation::all();
        return view('products.variations.index', compact('variations'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();
        $variations = ProductVariation::all();
        return view('products.variations.create', compact('subcategories', 'categories', 'variations'));
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

        return redirect()->route('products.variations.create')->with('success', 'Variation created successfully');
    }

    public function edit(ProductVariation $variation)
    {
        $subcategories = ProductSubcategory::all();
        return view('products.variations.edit', compact('variation', 'subcategories'));
    }

    public function update(Request $request, ProductVariation $variation)
    {
        $request->validate([
            'subcategory_id' => 'required',
            'color' => 'nullable',
            'size' => 'nullable',
            'weight' => 'nullable',
            'length' => 'nullable',
            'liquid_volume' => 'nullable',
        ]);

        $variation->update($request->all());

        return redirect()->route('products.variations.create')->with('success', 'Variation updated successfully');
    }

    public function destroy(ProductVariation $variation)
    {
        $variation->delete();

        return redirect()->route('products.variations.create')->with('success', 'Variation deleted successfully');
    }
}
