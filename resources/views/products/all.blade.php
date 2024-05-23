@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@include('layouts.panels.admin_panel.navbar')
<div class = "container">
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Item</th>
            <th>Category</th>
            <th>Sub-Category</th>
            <th>Variations</th>
        </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
                    <td>{{ $item->name }}</td>
            @foreach($item->categories as $category)
            @foreach($category->subcategories as $subcategory)
                    <td>{{ $category->name }}</td>
                    <td>{{ $subcategory->name }}</td>
                    <td>
            @foreach($subcategory->variations as $variation)
                            {{ $variation->color }}, {{ $variation->size }}, {{ $variation->weight }}, {{ $variation->length }}, {{ $variation->liquid_volume }}<br>
            @endforeach
                    </td>
        </tr>
            @endforeach
            @endforeach
    @endforeach
    </tbody>
</table>
</div>

@endsection