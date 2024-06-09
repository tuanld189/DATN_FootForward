<?php

use App\Models\Brand;
use App\Models\Category;
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
        Schema::dropIfExists('products');
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained();
            $table->foreignIdFor(Brand::class)->constrained();
            // $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            // $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('view_count')->default(0);
            $table->integer('quantity');
            $table->text('content')->nullable();
            $table->boolean('is_hot_deal')->default(false);
            $table->boolean('is_new')->default(true);
            $table->boolean('is_show_home')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
