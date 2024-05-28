<!-- resources/views/users/index.blade.php -->

@extends('layouts.panels.admin_panel.dashboard')
@section('content')

        
 
    <h1>All Users</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th class="col-md-2">Name</th>
                <th class="col-md-2">Mobile Number</th>
                <th class="col-md-2">User Role</th>
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
                <td>
                    @if($user->user_role == '1')
                    Admin(Shop Owner)
                    @elseif($user->user_role == '2')
                    Customer
                    @elseif($user->user_role == '10')
                    Vendor
                    @endif
                </td>
                <td>{{ $user->created_at }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}">Edit</a>
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
                    <td colspan="8">No users found</td>
                </tr>     
            @endforelse
                
           
        </tbody>
    </table>
@endsection

                        
