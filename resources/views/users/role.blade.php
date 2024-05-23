@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@include('layouts.panels.admin_panel.navbar')
    <div class="container col-md-6">
        <h4>User Details</h4>
        <hr>
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')
        <table
            class="table table-striped table-bordered table-hover table-condensed">
            <tbody>
            <tr>
                <td>Name</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td>Mobile Number</td>
                <td>
                    <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ $user->mobile_number }}" required autocomplete="mobile_number">
                    @error('mobile_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <td>Referral Mobile Number</td>
                <td>{{ $user->ref_mobile_number }}</td>
            </tr>
            <tr>
                <td>Referral Name</td>
                <td>
                        <span id="referral_name"></span>
                </td>
            </tr>
            <tr>
                <td>User Role</td>
                <td>
                    <select id="user_role" class="form-control @error('user_role') is-invalid @enderror" name="user_role" required>
                        <option value="">Select user Role</option>
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>   
                        @endforeach
                    </select>
                        @error('user_role')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </td>
            </tr>
            <tr>
                <td>City</td>
                <td>
                    <select id="city" class="form-control @error('city') is-invalid @enderror" name="city" required>
                        <option value="">Select City</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->name }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>GST Number</td>
                <td>
                    <input id="gst_no" type="text" class="form-control @error('gst_no') is-invalid @enderror" name="gst_no" value="{{ $user->gst_no }}">
                    @error('gst_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>With us from</td>
                <td>{{ $user->created_at }}</td>
            </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Update</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Role</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($roles as $role)
                <tr>
                    
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                        
                    @empty
                      <td colspan="2">No roles found</td>  
                    
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <script>
        document.getElementById('ref_mobile_number').addEventListener('blur', function() {
                // Get the referral mobile number
                var referralMobileNumber = document.getElementById('ref_mobile_number').value;

                // Make an AJAX request to get the referral name
                fetch(`/getReferralName?referralMobileNumber=${referralMobileNumber}`)
                    .then(response => response.json())
                    .then(data => {
                        // Update the Referral Name field
                        document.getElementById('referral_name').innerText = data.name;
                    })
                    .catch(error => {
                        console.error('Error fetching Referral Name:', error);
                    });
            });
    </script>
@endsection