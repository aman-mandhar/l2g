@extends('layouts.panels.admin_panel.vendorlayout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Sale for Customer</div>
                <div class="card-body">
                    <form method="get" action="{{ route('vendor_sales.check') }}">
                        <div class="form-group">
                            <label for="mobile_number">Mobile Number</label>
                            <input type="text" required class="form-control" id="mobile_number" name="mobile_number" placeholder="Enter Mobile Number" value="{{ old('mobile_number') }}">
                            @error('mobile_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        @if($errors->any())
                            <script>
                                alert("Insert 10 digit mobile number only.");
                            </script>
                        @endif
                            <button type="submit" class="btn btn-primary">Check_In</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
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