@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@include('layouts.panels.admin_panel.navbar')
    <div class="container">
        <h5>Add Sub-Category in item</h5>
        <form action="{{ route('products.items.update', $item->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="variation_id">Variation:</label>
                <select name="variation_id" id="variation_id" class="form-control">
                    <option value="">Select Variation</option>
                    @foreach($variations as $variation)
                        <option value="{{ $variation->id }}">{{ $variation->color }} - {{ $variation->size }}</option>
                    @endforeach
                </select>
            </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection