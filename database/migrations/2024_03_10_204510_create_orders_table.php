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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->foreignId('user_id');
            $table->decimal('gst', 8,2)->nullable();
            $table->decimal('amount', 8, 2);
            $table->decimal('cash', 8, 2)->nullable();
            $table->decimal('card', 8, 2)->nullable();
            $table->decimal('upi', 8, 2)->nullable();
            $table->decimal('spl_discount', 8, 2)->nullable();
            $table->string('status')->default('Pending');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
