@extends('layouts.panels.admin_panel.dashboard')
@include('layouts.panels.admin_panel.navbar')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Add Vendor</h1>
            <form method="POST" action="{{ route('vendors.store') }}">
                @method('POST')
                @csrf
                User Name : {{ $user->name }}<br>
                
                <div class="form-group">
                    <label for="vendor_name">Vendor Name</label>
                    <input type="text" class="form-control" id="vendor_name" name="vendor_name">
                </div>
                <div class="form-group">
                    <label for="add">Vendor Address</label>
                    <input type="text" class="form-control" id="add" name="add">
                </div>
                <div class="form-group">
                    <label for="email">Vendor Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="mobile_no">Vendor Phone</label>
                    <input type="text" class="form-control" id="mobile_no" name="mobile_no">
                </div>
                <div class="form-group">
                    <label for="mobile_no">GST No.</label>
                    <input type="text" class="form-control" id="gst_no" name="gst_no">
                </div>
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add Vendor</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection