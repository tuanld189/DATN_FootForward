<?php

use App\Models\Order;
use App\Models\ProductVariant;
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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_variant_id')->constrained()->onDelete('cascade');

            $table->unsignedInteger('quantity_add')->default(0);

            // Sao lưu thông tin sản phẩm
            $table->string('product_name');
            $table->string('product_sku');
            $table->string('product_image')->nullable();
            $table->double('product_price');
            $table->double('product_sale_price')->nullable();

            // Sao lưu thông tin biến thể
            $table->string('variant_size_name');
            $table->string('variant_color_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
