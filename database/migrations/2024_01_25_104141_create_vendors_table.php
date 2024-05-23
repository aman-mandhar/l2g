<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
                $table->id(); // Auto-increment ID
                $table->unsignedBigInteger('user_id');
                $table->string('add'); // Address
                $table->string('vendor_name');
                $table->string('mobile_no', 10); // Mobile Number
                $table->string('email')->unique(); // Email Address
                $table->string('aadhar_no', 12)->nullable(); // Aadhar Number
                $table->string('pan_no', 10)->nullable(); // PAN Number
                $table->string('gst_no', 15); // GST Number
                $table->string('msme_no', 12)->nullable(); // MSME Number
                $table->string('upi_id')->nullable(); // UPI ID
                $table->string('bank_name')->nullable(); // Bank Name
                $table->string('branch_name')->nullable(); // Branch Name
                $table->string('ifsc_code', 11)->nullable(); // IFSC Code
                $table->string('account_no', 18)->nullable(); // Account Number
                $table->string('account_holder_name')->nullable(); // Account Holder Name
                $table->string('account_type')->nullable(); // Account Type
                $table->string('aadhar_front')->nullable(); // Aadhar Front
                $table->string('aadhar_back')->nullable(); // Aadhar Back
                $table->string('pan_card')->nullable(); // PAN Card
                $table->string('gst_certificate')->nullable(); // GST Certificate
                $table->string('msme_certificate')->nullable(); // MSME Certificate
                $table->string('cancel_cheque')->nullable(); // Cancel Cheque
                $table->string('photo')->nullable(); // Photo
                $table->timestamps(); // Adds created_at and updated_at
    
                // user_id is a foreign key referencing users table:
                $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
