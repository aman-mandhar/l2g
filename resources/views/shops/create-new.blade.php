@extends('layouts.panels.admin_panel.dashboard')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Add New Shop</h1><br>
            <form method="POST" action="{{ route('shops.store') }}">
                @method('POST')
                @csrf
                <div class="form-group">
                    <label for="shop_name">Shop Name</label>
                    <input type="text" class="form-control" id="shop_name" name="shop_name">
                </div>
                <div class="form-group">
                    <label for="add">Shop Address</label>
                    <input type="text" class="form-control" id="add" name="add">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="mobile_no">Phone</label>
                    <input type="text" class="form-control" id="mobile_no" name="mobile_no">
                </div>
                <div class="form-group">
                    <label for="mobile_no">GST No.</label>
                    <input type="text" class="form-control" id="gst_no" name="gst_no">
                </div>
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add Shop</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection