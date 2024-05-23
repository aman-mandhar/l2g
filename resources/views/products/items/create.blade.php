@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@include('layouts.panels.admin_panel.navbar')
    <div class="container">
        <h5>Add New Item</h5>
        <form action="{{ route('products.items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="e.g. Dawat Rozana Basmati Rice 1 Kg " required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter Item Description e.g. For Biryani and Pulao" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="prod_pic">Upload Product Image:</label>
                <input type="file" name="prod_pic" id="prod_pic" class="form-control">
            </div>
            <div class="form-group">
                <label for="type">Product Type:</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="Pack">Pack</option>
                    <option value="Loose">Loose</option>
                    <!-- Add other types as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="gst">GST Rate:</label>
                <input type="number" name="gst" id="gst" class="form-control" placeholder="Applicable GST in Percentage e.g. 18" required>
            </div>
           <div class="form-group">
                <label for="token_id">Apply Token System:</label>
                <select name="token_id" id="token_id" class="form-control" required>
                    @forelse ($tokens as $token)
                        <option value="{{ $token->id }}">{{ $token->title }}</option>
                    @empty
                        <option value="">No Token System Found</option>                    
                    @endforelse 
                </select>
                <b>If you want to CREATE a NEW Token System</b> <a href="{{ route('tokens.create') }}">click here</a>
            </div>
            <div class="container">
                <label for="category_id">Category:</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <b>If you want to CREATE a NEW Category</b> <a href="{{ route('products.categories.create') }}">click here</a>
            </div>
    
            <div class="form-group">
                <label for="subcategory_id">Sub-Category:</label>
                <select name="subcategory_id" id="subcategory_id" class="form-control">
                    <option value="">Select Sub-Category</option>
                    {{-- Options will be dynamically updated using JavaScript --}}
                </select>
                <b>If you want to CREATE a NEW Sub-Category</b> <a href="{{ route('products.subcategories.create') }}">click here</a>
            </div>
    
            <div class="form-group">
                <label for="variation_id">Product Variation:</label>
                <select name="variation_id" id="variation_id" class="form-control">
                    <option value="">Select Variation</option>
                    {{-- Options will be dynamically updated using JavaScript --}}
                </select>
                <b>If you want to CREATE a NEW Product Variation</b> <a href="{{ route('products.variations.create') }}">click here</a>
            </div>
                  
                
            <button type="submit" class="btn btn-primary">SUBMIT</button>
        </form>

        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {
            // Your existing JavaScript code

            // Event listener for the category dropdown
            $('#category_id').on('change', function () {
                var categoryId = $(this).val(); // Get the selected category id

                // Make an AJAX request to fetch related subcategories
                $.ajax({
                    type: 'GET',
                    url: '/get-subcategories/' + categoryId, // Replace with your actual route
                    success: function (data) {
                        // Update the subcategory dropdown options
                        $('#subcategory_id').html(data);
                    }
                });
            });

            // Event listener for the subcategory dropdown
            $('#subcategory_id').on('change', function () {
                var subcategoryId = $(this).val(); // Get the selected subcategory id

                // Make an AJAX request to fetch related variations
                $.ajax({
                    type: 'GET',
                    url: '/get-variations/' + subcategoryId, // Replace with your actual route
                    success: function (data) {
                        // Update the variation dropdown options
                        $('#variation_id').html(data);
                    }
                });
            });
        });
    </script>
    </div>
    
@endsection
