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
        Schema::create('employees', function (Blueprint $table) {
                $table->id(); // Auto-increment ID
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('ref_id')->default('1');
                $table->string('name'); // Full Name
                $table->string('add'); // Address
                $table->string('city');
                $table->string('Employee_name');
                $table->string('mobile_no', 10); // Mobile Number
                $table->string('email')->unique(); // Email Address
                $table->string('Aadhar_no', 12)->nullable(); // Aadhar Number
                $table->string('pan_no', 10)->nullable(); // PAN Number
                $table->string('upi_id')->nullable(); // UPI ID
                $table->string('bank_name')->nullable(); // Bank Name
                $table->string('branch_name')->nullable(); // Branch Name
                $table->string('ifsc_code', 11)->nullable(); // IFSC Code
                $table->string('account_no', 18)->nullable(); // Account Number
                $table->string('account_holder_name')->nullable(); // Account Holder Name
                $table->string('account_type')->nullable(); // Account Type
                $table->string('Aadhar_front')->nullable(); // Aadhar Front
                $table->string('Aadhar_back')->nullable(); // Aadhar Back
                $table->string('pan_card')->nullable(); // PAN Card
                $table->string('cancel_cheque')->nullable(); // Cancel Cheque
                $table->string('photo')->nullable(); // Photo
                $table->timestamps(); // Adds created_at and updated_at
    
                // user_id is a foreign key referencing users table:
                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('ref_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
