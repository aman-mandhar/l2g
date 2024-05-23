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
                    @foreach($vendors as $vendor)
                    <tr>
                        <td>{{ $vendor->vendor_name }}</td>
                        <td>{{ $vendor->add }}</td>
                        <td>{{ $vendor->city }}</td>
                        <td>{{ $vendor->mobile_no }}</td>
                        <td>
                            <a href="{{ route('vendors.edit', $vendor->id) }}" class="btn btn-warning">Edit</a>
                            <form style="display:inline-block" method="POST" action="{{ route('vendors.destroy', $vendor->id) }}">
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


