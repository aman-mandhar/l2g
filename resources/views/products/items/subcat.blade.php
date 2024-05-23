@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@include('layouts.panels.admin_panel.navbar')
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Category</th>
                    <th>Token System</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->token->title }}</td>
                </tr>
            </tbody>
        </table>
        <h5>Add Sub-Category in item</h5>
        <form action="{{ route('products.items.update', $item->id) }}" method="post" enctype="multipart/form-data">
            @csrf
        <div class="form-group">
            <label for="subcategory_id">Subcategory:</label>
            <select name="subcategory_id" id="subcategory_id" class="form-control">
                <option value="">Select Sub-Category</option>
                    @foreach($subcategories as $subcategory)
                <option value="{{ $subcategory->id }}">{{ $subcategory->name }} ({{ $subcategory->category->name }})</option>
                    @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">NEXT</button>
        </form>
    </div>
@endsection