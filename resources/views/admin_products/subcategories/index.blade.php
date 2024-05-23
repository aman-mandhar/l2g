@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@include('layouts.panels.admin_panel.navbar')
    

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
                        <td><img src="{{ asset('images/'.$subcategory->image) }}" alt="{{ $subcategory->name }}" width="100"></td>
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
        <a href="{{ route('products.subcategories.create')}}"><button type="submit" class="btn btn-primary">Add Subcategory</button></a>
    </div>
@endsection