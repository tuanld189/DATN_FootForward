<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Foreign key for user_id
            $table->foreignIdFor(User::class)->constrained();

            // User information
            $table->string('order_code');
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_phone');
            $table->string('user_address')->nullable();
            $table->string('user_password')->nullable();
            $table->string('user_note')->nullable();
            $table->string('province_code')->nullable(); // Changed to use code instead of id
            $table->string('district_code')->nullable(); // Changed to use code instead of id
            $table->string('ward_code')->nullable(); // Changed to use code instead of id

            // Shipping information
            $table->boolean('is_ship_user_same_user')->default(true);
            $table->string('ship_user_name')->nullable();
            $table->string('ship_user_email')->nullable();
            $table->string('ship_user_phone')->nullable();
            $table->string('ship_user_address')->nullable();
            $table->string('ship_province_code')->nullable(); // Changed to use code instead of id
            $table->string('ship_district_code')->nullable(); // Changed to use code instead of id
            $table->string('ship_ward_code')->nullable(); // Changed to use code instead of id
            $table->string('ship_user_note')->nullable();

            // Order and payment status
            $table->string('status_order')->default(\App\Models\Order::STATUS_ORDER_PENDING);
            $table->string('status_payment')->default(\App\Models\Order::STATUS_PAYMENT_UNPAID);

            // Foreign key constraints updated
            $table->foreign('province_code')->references('code')->on('provinces');
            $table->foreign('district_code')->references('code')->on('districts');
            $table->foreign('ward_code')->references('code')->on('wards');

            // Total price
            $table->double('total_price', 15, 2)->default(0.00);

            $table->timestamps();
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
