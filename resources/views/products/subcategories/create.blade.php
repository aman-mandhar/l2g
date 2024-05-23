@extends('layouts.panels.vendor_panel.main')
@section('content')
    <div class="container">
        <h5>Add New Subcategory</h5>
        <form action="{{ route('products.subcategories.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="name">Subcategory Name:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Subcategory Name">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" placeholder="Enter Subcategory Description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Subcategory Image:</label>
                <input type="file" name="image" id="image" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Add Subcategory</button>
        </form>

        <h5>All Subcategories</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Subcategory Name</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subcategories as $subcategory)
                    <tr>
                        <td><img src="{{ asset('images/' .$subcategory->image) }}" alt="{{ $subcategory->name }}" width="100"></td>
                        <td>{{ $subcategory->name }}</td>
                        <td>{{ $subcategory->category->name }}</td>
                        <td>{{ $subcategory->description }}</td>
                        <td>
                            <form action="{{ route('products.subcategories.edit', $subcategory->id) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </form>
                            <form action="{{ route('products.subcategories.destroy', $subcategory->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this subcategory?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No subcategories found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
