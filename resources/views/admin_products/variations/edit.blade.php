@extends('layouts.panels.admin_panel.dashboard')
@section('content')

<div class="container">
    <form action="{{ route('products.variations.update', $variation->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="subcategory_id">Subcategory</label>
            <select name="subcategory_id" id="subcategory_id" class="form-control">
                @foreach($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" name="color" id="color" class="form-control" value="{{ $variation->color }}"> 
        </div>
        <div class="form-group">
            <label for="size">Size</label>
            <input type="text" name="size" id="size" class="form-control" value="{{ $variation->size }}">
        </div>
        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="text" name="weight" id="weight" class="form-control" value="{{ $variation->weight }}">
        </div>
        <div class="form-group">
            <label for="length">Length</label>
            <input type="text" name="length" id="length" class="form-control" value="{{ $variation->length }}">
        </div>
        <div class="form-group">
            <label for="liquid_volume">Liquid Volume</label>
            <input type="liquid_volume" name="liquid_volume" id="liquid_volume" class="form-control" value="{{ $variation->liquid_volume }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Variation</button>
    </form>
</div>    
@endsection