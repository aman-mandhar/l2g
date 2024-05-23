@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Retail Stores</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('retails.create') }}" class="btn btn-success">Create Retail Store</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Store Address</th>
                    <th>City</th>
                    <th>Manager</th>
                    <th>Mobile No</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($retails as $retail)
                    <tr>
                        <td>{{ $retail->id }}</td>
                        <td>{{ $retail->user->name }}</td>
                        <td>{{ $retail->store_add }}</td>
                        <td>{{ $retail->city }}</td>
                        <td>{{ $retail->manager }}</td>
                        <td>{{ $retail->mobile_no }}</td>
                        <td>
                            <a href="{{ route('retails.edit', $retail->id) }}" class="btn btn-primary">Edit</a>
                            <!-- Add delete button/form if needed -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
