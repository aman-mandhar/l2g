<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    public function search(Request $request)
{
    $search = $request->input('search');

    $categories = ProductCategory::where('name', 'like', '%' . $search . '%')
        ->orWhere('description', 'like', '%' . $search . '%')
        ->get();

    return view('products.categories.create', compact('categories'));
}

    
    public function index()
    {
        $categories = ProductCategory::all();
        return view('products.categories.create', compact('categories'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        return view('products.categories.create', compact('categories'));
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
        return redirect()->route('products.categories.index')->with('success', 'Category created successfully');
    } else {
        
        
        return back()->withInput()->with('error', 'Failed to create category', 'error_req', 'error_val');
    }
}


    
        
                
        

    public function edit(ProductCategory $category)
    {
        
        return view('products.categories.edit', compact('category'));
    }

    public function update(Request $request , ProductCategory $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/categories');
            $image->move($destinationPath, $image_name);
            $request->merge(['image' => $image_name]);
        }

        $category->update($request->all());

        return redirect()->route('products.categories.create')->with('success', 'Category updated successfully');
    }

    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return redirect()->route('products.categories.create')->with('success', 'Category deleted successfully');
    }
}

