@extends('layouts.panels.admin_panel.dashboard')
@section('content')
<form action="{{ route('products.subcategories.update', $subcategory->id)}}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="category_id">Category: {{ $category->name }}</label>
        <select name="category_id" id="category_id" class="form-control">
            <option value="{{ $category->id }}">Select to change</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="name">Subcategory Name: {{ $subcategory->name }}</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $subcategory->name }}">
    </div>
    <div class="form-group">
        <label for="description">Description: {{ $subcategory->description }}</label>
        <textarea name="description" id="description" class="form-control" rows="3">{{ $subcategory->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="image">Subcategory Image:</label>
        <input type="file" name="image" id="image" class="form-control-file">
    </div>
    <button type="submit" class="btn btn-primary">Update Subcategory</button>
</form>
@endsection
