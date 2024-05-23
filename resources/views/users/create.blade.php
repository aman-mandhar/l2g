@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@include('layouts.panels.admin_panel.navbar')

<div class="card-body">
    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="mobile_number" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

            <div class="col-md-6">
                <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number') }}" required autocomplete="mobile_number">

                @error('mobile_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="ref_mobile_number" class="col-md-4 col-form-label text-md-right">{{ __('Reference Mobile Number') }}</label>

            <div class="col-md-6">
                <input id="ref_mobile_number" type="text" class="form-control @error('ref_mobile_number') is-invalid @enderror" name="ref_mobile_number" value="0000000000" required autocomplete="ref_mobile_number">

                @error('ref_mobile_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="referral_name" class="col-md-4 col-form-label text-md-end">{{ __('Referral Name') }}</label>
            <div class="col-md-6">
                <span id="referral_name"></span>
            </div>
        </div>

        <div class="form-group row">
            <label for="user_role" class="col-md-4 col-form-label text-md-right">{{ __('User Role') }}</label>

            <div class="col-md-6">
                <select id="user_role" class="form-control @error('user_role') is-invalid @enderror" name="user_role" required>
                    <option value="">Select User Role</option>
                    @foreach ($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>   
                    @endforeach
                </select>

                @error('user_role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- Add more fields based on your controller -->

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" value="12345678" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" value="12345678" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="form-group row">
            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

            <div class="col-md-6">
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
            </div>
        </div>

        <div class="form-group row">
            <label for="gst_no" class="col-md-4 col-form-label text-md-right">{{ __('GST Number') }}</label>

            <div class="col-md-6">
                <input id="gst_no" type="text" class="form-control @error('gst_no') is-invalid @enderror" name="gst_no" value="{{ old('gst_no') }}" autocomplete="gst_no">

                @error('gst_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    SUBMIT
                </button>
            </div>
        </div>
    </form>
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
    
    // Function to update the email field based on mobile_number
    function updateEmail() {
        var mobileNumberInput = document.getElementById('mobile_number');
        var emailInput = document.getElementById('email');

        if (mobileNumberInput && emailInput) {
            var mobileNumberValue = mobileNumberInput.value;
            var domain = '@zksuperstore.com';

            // Update the email input value
            emailInput.value = mobileNumberValue + domain;
        }
    }

    // Attach the event listener to the mobile_number input
    document.getElementById('mobile_number').addEventListener('input', updateEmail);

</script>
@endsection
    
