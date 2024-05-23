@extends('layouts.panels.admin_panel.dashboard')
@section('content')

<div class="row">
    <div class="col-md-12">
        <h1>Edit Category</h1>
    </div>
</div>

<div class="container">
    <form action="{{ route('products.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
        </div>
        <div class="form-group">
            <label for="description">Category Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $category->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Category Image</label>
            <input type="text" class="form-control" id="image" name="image" value="{{ $category->image }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>

@endsection