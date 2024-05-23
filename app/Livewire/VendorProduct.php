<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\ProductVariation;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class VendorProduct extends Component
{
    use WithFileUploads;
    
    public $name;
    public $description;
    public $prod_pic;
    public $type;
    public $gst;
    public $category_id;
    public $subcategory_id;
    public $variation_id;
    public $productCategories;
    public $productSubcategories;
    public $productVariations;
    
    public function mount()
    {
        $this->productCategories = ProductCategory::all();
        $this->productSubcategories = ProductSubcategory::all();
        $this->productVariations = ProductVariation::all();
        }

    public function updatedCategoryId($value)
    {
        $this->productSubcategories = ProductSubcategory::where('category_id', $value)->get();
    }

    public function updatedSubcategoryId($value)
    {
        $this->productVariations = ProductVariation::where('subcategory_id', $value)->get();
    }

    public function store()
    {
    $validatedData = $this->validate([
        'name' => 'required',
        'description' => 'nullable',
        'prod_pic' => 'nullable|image|max:1024', // Example validation for image upload
        'type' => 'required',
        'gst' => 'required|numeric',
        'category_id' => 'required',
        'subcategory_id' => 'nullable',
        'variation_id' => 'nullable',
    ]);

    // Move uploaded file to the public/products directory
    
    if ($this->prod_pic) {
        $path = $this->prod_pic->store('public/products');
        $validatedData['prod_pic'] = basename($path);
        $move = Storage::move($path, 'public/products/' . $validatedData['prod_pic']);
    }

    
    $product = new Product();
    $product->fill($validatedData);
    $product->created_by = Auth::user()->id;
    $product->save();

    session()->flash('message', 'Product created successfully.');
    return redirect()->route('vendor_products.create');
    }

    public function render()
    {
        return view('livewire.vendor-product');
    }
}