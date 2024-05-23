@extends('layouts.panels.admin_panel.dashboard')
@section('content')
    <div class="container">
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