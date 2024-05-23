@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@include('layouts.panels.admin_panel.navbar')
    
<h5>All Variations</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Colour</th>
                    <th>Size</th>
                    <th>Weight</th>
                    <th>Length</th>
                    <th>Liquid Volume</th>
                    <th>Subcategory</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($variations as $variation)
                    <tr>
                        <td>{{ $variation->color }}</td>
                        <td>{{ $variation->size }}</td>
                        <td>{{ $variation->weight }}</td>
                        <td>{{ $variation->length }}</td>
                        <td>{{ $variation->liquid_volume }}</td>
                        <td>{{ $variation->subcategory->name }}</td>
                        <td>{{ $variation->subcategory->category->name }}</td>
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