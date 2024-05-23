@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@include('layouts.panels.admin_panel.navbar')
            <div class="card-header">Create New Customer</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('sales.newuser') }}">
                        @csrf
                            <input id="name" hidden type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="Customer Name" required autocomplete="name" autofocus>
                
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                
                        <div class="form-group row">
                            <label for="mobile_number" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>
                
                            <div class="col-md-6">
                                <input id="mobile_number" value="{{ $mobile_number }}" type="tel" class="form-control" name="mobile_number" required autocomplete="mobile_number"> 
                                
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
                
                                <select id="user_role" hidden class="form-control @error('user_role') is-invalid @enderror" name="user_role" required>
                                    <option value="1">Customer</option>
                                </select>
                
                                @error('user_role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                
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
                
                        
                                <input id="password" hidden type="password" value="12345678" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                
                                <input id="password-confirm" hidden type="password" value="12345678" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            
                
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                
                            <div class="col-md-6">
                                <select id="city" class="form-control @error('city') is-invalid @enderror" name="city" required>
                                    <option value="Amritsar">Amritsar</option>
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
                
                                     
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    SUBMIT
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                // Function to update the referral name based on the referral mobile number
                function updateReferralName() {
                    var referralMobileNumber = document.getElementById('ref_mobile_number').value;
                    var referralNameElement = document.getElementById('referral_name');
            
                    // Make an AJAX request to get the referral name
                    fetch(`/getReferralName?referralMobileNumber=${referralMobileNumber}`)
                        .then(response => response.json())
                        .then(data => {
                            // Update the Referral Name field
                            referralNameElement.innerText = data.name;
                        })
                        .catch(error => {
                            console.error('Error fetching Referral Name:', error);
                        });
                }
            
                // Attach the event listener to the referral mobile number input
                document.getElementById('ref_mobile_number').addEventListener('blur', updateReferralName);
            
                // Function to update the email field based on the mobile number
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
            
                // Attach the event listener to the mobile number input
                document.getElementById('mobile_number').addEventListener('input', updateEmail);
            
                // Initial update of referral name and email when the page loads
                updateReferralName();
                updateEmail();
            </script>

@endsection

