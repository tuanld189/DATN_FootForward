<?php

use App\Models\District;
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
        Schema::create('wards', function (Blueprint $table) {
            $table->string('code', 20)->primary();
            $table->string('name', 255);
            $table->string('name_en', 255)->nullable();
            $table->string('full_name', 255)->nullable();
            $table->string('full_name_en', 255)->nullable();
            $table->string('code_name', 255)->nullable();
            $table->string('district_code', 20)->nullable();
            $table->integer('administrative_unit_id')->nullable();

            $table->foreign('district_code')->references('code')->on('districts');
            $table->foreign('administrative_unit_id')->references('id')->on('administrative_units');

            $table->index('district_code', 'idx_wards_district');
            $table->index('administrative_unit_id', 'idx_wards_unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wards');
    }
};
