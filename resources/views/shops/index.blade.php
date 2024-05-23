@extends('layouts.panels.admin_panel.dashboard')
@include('layouts.panels.admin_panel.navbar')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Vendors</h1>
            <a href="{{ route('vendors.create') }}" class="btn btn-primary">Add Vendor</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Vendor Name</th>
                        <th>Vendor Address</th>
                        <th>Vendor City</th>
                        <th>Vendor Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shops as $shop)
                    <tr>
                        <td>{{ $shop->shop_name }}</td>
                        <td>{{ $shop->add }}</td>
                        <td>{{ $shop->city }}</td>
                        <td>{{ $shop->mobile_no }}</td>
                        <td>
                            <form style="display:inline-block" method="POST" action="{{ route('shops.destroy', $shop->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



@endsection


