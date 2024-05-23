@extends('layouts.panels.vendor_panel.main')
@section('content')
    <div class="container">
        <h5>Add New Category</h5>
        <form action="{{ route('products.categories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Category Name:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Category Name">
            </div>

            <div class="form-group">
                <label for="description">Category Description:</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Enter Category Description"></textarea>
            </div>

            <div class="form-group">
                <label for="image">Category Image:</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>

        <hr>

        <h5>Search Categories</h5>
            <form action="{{ route('products.categories.search') }}" method="GET">
                <div class="form-group">
                    <label for="search">Search:</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search by Name or Description">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

        <h5>All Categories</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Category Description</th>
                    <th>Category Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <img src="{{ asset('images/' . $category->image) }}" alt="{{ $category->name }}" width="100">
                        </td>
                        <td>
                            <form action="{{ route('products.categories.edit', $category->id) }}" method="get">
                                @csrf
                                @method('GET')
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </form>
                            
                            <form action="{{ route('products.categories.destroy', $category->id) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                                
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">No categories found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
