<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



class SubcategoryController extends Controller
{
    public function search(Request $request)
    {
    $search = $request->input('search');

    $subcategories = Productsubcategory::where('name', 'like', '%' . $search . '%')
        ->orWhere('description', 'like', '%' . $search . '%')
        ->get();
    $user = auth()->user();
        if ($user->user_role == '10') {
            return view('products.subcategories.create', compact('categories', 'subcategories'));
        } else if ($user->user_role == '1') {
            return view('admin_products.subcategories.create', compact('categories', 'subcategories'));
        }
    }

    public function create()
    {
        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();
        $user = auth()->user();
        if ($user->user_role == '10') {
            return view('products.subcategories.create', compact('categories', 'subcategories'));
        } else if ($user->user_role == '1') {
            return view('admin_products.subcategories.create', compact('categories', 'subcategories'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:product_categories,id',
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules for image upload
        ]);
    
        $imageName = null;
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $imageName);
        }
    
        $subcategory = ProductSubcategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName, // Store the image filename in the database
        ]);
    
        if ($subcategory) {
            $user = auth()->user();
            if ($user->user_role == '10') {
                $categories = ProductCategory::all();
                $subcategories = ProductSubcategory::all();
                return view('products.subcategories.create', compact('categories', 'subcategories'));
            } else if ($user->user_role == '1') {
                $categories = ProductCategory::all();
            $subcategories = ProductSubcategory::all();
                return view('admin_products.subcategories.create', compact('categories', 'subcategories'));
        }
        } else {
            return back()->withInput()->with('error', 'Failed to create category');
        }
    }

    
        public function destroy(ProductSubcategory $subcategory)
        {
        $subcategory->delete();

        $user = auth()->user();
        if ($user->user_role == '10') {
            $categories = ProductCategory::all();
            $subcategories = ProductSubcategory::all();
            return view('products.subcategories.create', compact('categories', 'subcategories'));
        } else if ($user->user_role == '1') {
            return view('admin_products.subcategories.create', compact('categories', 'subcategories'));
        }
        }
}

