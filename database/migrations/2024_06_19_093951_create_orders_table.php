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

            // Khóa ngoại user_id
            $table->foreignIdFor(User::class)->constrained();

            // Khóa ngoại product_variant_id, cho phép null và liên kết tới product_variant
            $table->foreignId('product_variant_id')->nullable()->constrained();

            // Thông tin người dùng
            $table->string('order_code');
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_phone');
            $table->string('user_address')->nullable();
            $table->string('user_password')->nullable();
            $table->string('user_note')->nullable();

            // Thông tin giao hàng
            $table->boolean('is_ship_user_same_user')->default(true);
            $table->string('ship_user_name')->nullable();
            $table->string('ship_user_email')->nullable();
            $table->string('ship_user_phone')->nullable();
            $table->string('ship_user_address')->nullable();
            $table->string('ship_user_note')->nullable();

            // Trạng thái đơn hàng
            $table->string('status_order')->default(\App\Models\Order::STATUS_ORDER_PENDING);
            $table->string('status_payment')->default(\App\Models\Order::STATUS_PAYMENT_UNPAID);

            // Tổng giá tiền
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
