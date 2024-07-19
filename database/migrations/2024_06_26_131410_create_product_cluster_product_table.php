<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductClusterProductTable extends Migration
{
    public function up()
    {
        Schema::create('product_cluster_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_cluster_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_cluster_product');
    }
}
