@extends('layouts.panels.admin_panel.dashboard')
@section('content')

<div class="container">
    <div class="row">
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
    </div>
</div>
@endsection