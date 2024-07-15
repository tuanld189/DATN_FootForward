<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductClusterIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('product_cluster_id')->nullable();

            // Nếu bạn muốn thiết lập quan hệ khóa ngoại
            $table->foreign('product_cluster_id')->references('id')->on('product_clusters')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['product_cluster_id']);
            $table->dropColumn('product_cluster_id');
        });
    }
}

