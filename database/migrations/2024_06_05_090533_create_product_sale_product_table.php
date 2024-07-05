<?php

use App\Models\Product;
use App\Models\ProductSale;
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
        Schema::create('product_sale_product', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained('products')->onDelete('cascade');
            $table->foreignIdFor(ProductSale::class)->constrained('product_sales')->onDelete('cascade');
            $table->decimal('sale_price', 8, 2);
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sale_product');
    }
};
