@extends('layouts.panels.admin_panel.dashboard')
@section('content')

<div class="container">
    <div class="row">
        @if($shop != null)
        <div class="col-md-12">
            <h5>Shop is already created</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Shop Name</th>
                        <th>Shop Address</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>GST No.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shop as $shop)
                    <tr>
                        <td>{{ $shop->shop_name }}</td>
                        <td>{{ $shop->add }}</td>
                        <td>{{ $shop->email }}</td>
                        <td>{{ $shop->mobile_no }}</td>
                        <td>{{ $shop->gst_no }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="col-md-6">
            <h1>Add Shop</h1>
            <form method="POST" action="{{ route('shops.create_new') }}">
                @csrf
                <div class="form-group">
                    <label for="mobile_number">Registered Mobile No.</label>
                    <input type="text" class="form-control" id="mobile_number" name="mobile_number">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection