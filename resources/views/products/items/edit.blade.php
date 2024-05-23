@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@include('layouts.panels.admin_panel.navbar')
    <div class="container">
        <h2>Edit Item</h2>
        <form action="{{ route('products.items.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ $item->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="prod_pic">Upload Product Image:</label>
                <input type="file" name="prod_pic" id="prod_pic" class="form-control-file">
            </div>

            <div class="form-group row">
                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Product Type') }}</label>
                <div class="col-md-6">
                    <select id="type" class="form-control @error('type') is-invalid @enderror" name="type" required>
                        <option value="{{ $item->type }}">{{ $item->type }}</option>
                        <option value="Packet">Packet</option>
                        <option value="Loose">Loose</option>
                        
                    </select>
                    @error('type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="gst" class="col-md-4 col-form-label text-md-right">{{ __('GST Rate') }}</label>
                <div class="col-md-6">
                    <input id="gst" type="number" class="form-control @error('gst') is-invalid @enderror" name="gst" value="{{ $item->gst }}" required>
                    @error('gst')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="token_id" class="col-md-4 col-form-label text-md-right">{{ __('Token System') }}</label>
                <div class="col-md-6">
                    <select id="token_id" class="form-control @error('token_id') is-invalid @enderror" name="token_id" required>
                        <option value="{{ $item->token_id }}">Select to change</option>
                        @forelse ($tokens as $token)
                            <option value="{{ $token->id }}">{{ $token->title }}</option>
                        @empty
                            <option value="">No Token System Found</option>                    
                        @endforelse 
                    </select>
                    <b>If you want to CREATE a NEW Token System</b> <a href="{{ route('tokens.create') }}">click here</a>
                    @error('token_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
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
                    url: '/get-subcategories/' + categoryId, // Replace
                    with your actual route
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
                    url: '/get-variations/' + subcategoryId, // Replace
                    with your actual route
                    success: function (data) {
                        // Update the variation dropdown options
                        $('#variation_id').html(data);
                    }
                });
            });
        });
    </script>
                

            
@endsection