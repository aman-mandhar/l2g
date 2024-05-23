@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Edit Retail Store</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('retails.update', $retail->id) }}">
            @csrf
            @method('PUT')

            <!-- Add your form fields here -->
            <div class="form-group">
                <label for="user_id">User:</label>
                <select name="user_id" class="form-control">
                    @foreach($users as $user)
                        @if ($user->user_role == 2)
                            <option value="{{ $user->id }}" {{ $user->id == $retail->user_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Add other form fields -->

            <button type="submit" class="btn btn-primary">Update Retail Store</button>
        </form>
    </div>
@endsection
