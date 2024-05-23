@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@include('layouts.panels.admin_panel.navbar')
<div class="container">
    <form action="{{ route('users.search') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search by Name or Mobile Number" name="search" id="search" value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
        </div>
    </form>
</div>
<h1>User Table Data</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th class="col-md-2">Name</th>
            <th class="col-md-2">Mobile Number</th>
            <th class="col-md-2">Ref Number</th>
            <th class="col-md-2">Ref Name</th>
            <th class="col-md-2">User Role</th>
            <th class="col-md-2">City</th>
            <th class="col-md-2">Created At</th>
            <th class="col-md-2">Action</th>
            <th>destroy</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->mobile_number }}</td>
            <td>{{ $user->ref_mobile_number }}</td>
            <td>
                @php
                    $ref_user = $user->firstWhere('mobile_number', $user->ref_mobile_number);
                    $ref_name = $ref_user ? $ref_user->name : 'N/A';
                @endphp
                {{ $ref_name }}
            </td>
            <td>{{ $user->user_role }}</td>
            <td>{{ $user->city }}</td>
            <td>{{ $user->created_at }}</td>
            <td>
                <a href="{{ route('users.role', $user->id) }}">Change Role</a>
            </td>
            <td>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="9">No users found</td>
        </tr>
        @endforelse
    </tbody>
@endsection