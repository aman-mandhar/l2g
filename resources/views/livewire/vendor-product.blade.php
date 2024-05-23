<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h6>New Product</h6></div>
                <div class="card-body">
                    <form wire:submit.prevent="store" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control" id="name" wire:model.lazy="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Product Description</label>
                            <textarea class="form-control" id="description" wire:model.lazy="description"></textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="prod_pic">Product Picture</label>
                            <input type="file" class="form-control" id="prod_pic" wire:model.lazy="prod_pic">
                            @error('prod_pic') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="type">Product Type</label>
                            <select class="form-control" id="type" wire:model.lazy="type">
                                <option value="">Select Product Type</option>
                                <option value="1">Pack</option>
                                <option value="2">Loose</option>
                            </select>
                            @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="gst">Applicable GST Rate</label>
                            <input type="text" class="form-control" id="gst" wire:model.lazy="gst">
                            @error('gst') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Product Category</label>
                            <select class="form-control" id="category_id" wire:model.lazy="category_id">
                                <option value="">Select Product Category</option>
                                @foreach($productCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        @if($category_id)
                    @php
                        
                        $selectedSubcategory = $productSubcategories->where('category_id', $category_id);
                    @endphp
                            <div class="form-group">
                                <label for="subcategory_id">Product Sub Category</label>
                                <select class="form-control" id="subcategory_id" wire:model.lazy="subcategory_id">
                                    <option value="">Select Product Sub Category</option>
                                    @foreach($selectedSubcategory as $subCategory)
                                        <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                    @endforeach
                                </select>
                                @error('subcategory_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        @endif
                        @if($subcategory_id)
                    @php
                        $selectedVariation = $productVariations->where('subcategory_id', $subcategory_id);
                    @endphp 
                            <div class="form-group">
                                <label for="variation_id">Product Variant</label>
                                <select class="form-control" id="variation_id" wire:model.lazy="variation_id">
                                    <option value="">Select Product Variant</option>
                                    @foreach($selectedVariation as $variation)
                                        <option value="{{ $variation->id }}">{{ $variation->weight }} || 
                                                                             {{ $variation->length }} ||
                                                                             {{ $variation->liquid_volume }} ||
                                                                             {{ $variation->color }} ||
                                                                             {{ $variation->Size }}

                                        </option>
                                    @endforeach
                                </select>
                                @error('variation_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
