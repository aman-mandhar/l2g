<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class CategoryController extends Controller
{
    public function search(Request $request)
{
    $search = $request->input('search');

    $categories = ProductCategory::where('name', 'like', '%' . $search . '%')
        ->orWhere('description', 'like', '%' . $search . '%')
        ->get();
    $user = auth()->user();
    if ($user->user_role == '10') {
        return view('products.categories.create', compact('categories'));
    } else if ($user->user_role == '1') {
        return view('admin_products.categories.create', compact('categories'));
    }
}

    
    public function index()
    {
        $categories = ProductCategory::all();
        $user = auth()->user();
        if ($user->user_role == '10') {
            return view('products.categories.create', compact('categories'));
        } else if ($user->user_role == '1') {
            return view('admin_products.categories.create', compact('categories'));
        }
    }

    public function create()
    {
        $categories = ProductCategory::all();
        $user = auth()->user();
        if ($user->user_role == '10') {
            return view('products.categories.create', compact('categories'));
        } else if ($user->user_role == '1') {
            return view('admin_products.categories.create', compact('categories'));
        }
    }

    public function store(Request $request)
{
    $request->validate([
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

    $category = ProductCategory::create([
        'name' => $request->name,
        'description' => $request->description,
        'image' => $imageName, // Store the image filename in the database
    ]);

    if ($category) {
        $user = auth()->user();
        if ($user->user_role == '10') {
            $categories = ProductCategory::all();
            return view('products.categories.create', compact('categories'));
        } else if ($user->user_role == '1') {
            $categories = ProductCategory::all();
            return view('admin_products.categories.create', compact('categories'));
        }
    } else {
        
        
        return back()->withInput()->with('error', 'Failed to create category', 'error_req', 'error_val');
    }
}


    public function destroy(ProductCategory $category)
    {
        $category->delete();

        $user = auth()->user();
        if ($user->user_role == '10') {
            $categories = ProductCategory::all();
            return view('products.categories.create', compact('categories'));
        } else if ($user->user_role == '1') {
            $categories = ProductCategory::all();
            return view('admin_products.categories.create', compact('categories'));
        }
    }
}

