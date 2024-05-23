@extends('layouts.panels.admin_panel.dashboard')
@include('layouts.panels.admin_panel.navbar')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Add Vendor</h1>
            <form method="POST" action="{{ route('vendors.create_new') }}">
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
    </div>
</div>
@endsection