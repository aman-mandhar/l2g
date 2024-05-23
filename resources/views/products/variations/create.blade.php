@extends('layouts.panels.vendor_panel.main')
@section('content')
    <div class="container">
        <h5>Add New Variation</h5>
        <form action="{{ route('products.variations.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="subcategory_id">Subcategory</label>
                <select name="subcategory_id" id="subcategory_id" class="form-control">
                    @foreach($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->category->name }} / {{ $subcategory->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="color">Color</label>
                <input type="text" name="color" id="color" class="form-control">
            </div>
            <div class="form-group">
                <label for="size">Size</label>
                <input type="text" name="size" id="size" class="form-control">
            </div>
            <div class="form-group">
                <label for = "weight">Weight</label>
                <input type="text" name="weight" id="weight" class="form-control">
            </div>
            <div class="form-group">
                <label for = "length">Length</label>
                <input type="text" name="length" id="length" class="form-control">
            </div>
            <div class="form-group">
                <label for = "liquid_volume">Liquid Volume</label>
                <input type="liquid_volume" name="liquid_volume" id="liquid_volume" class="form-control">
            </div>              
            <button type="submit" class="btn btn-primary">Add Variation</button>
        </form>

        <h5>All Variations</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Colour</th>
                    <th>Size</th>
                    <th>Weight</th>
                    <th>Length</th>
                    <th>Liquid Volume</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($variations as $variation)
                    <tr>
                        <td>{{ $variation->subcategory->category->name }}</td>
                        <td>{{ $variation->subcategory->name }}</td>
                        <td>{{ $variation->color }}</td>
                        <td>{{ $variation->size }}</td>
                        <td>{{ $variation->weight }}</td>
                        <td>{{ $variation->length }}</td>
                        <td>{{ $variation->liquid_volume }}</td>
                        <td>
                            <a href="{{ route('products.variations.edit', $variation->id) }}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <form action="{{ route('products.variations.destroy', $variation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this variation?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No variations found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
