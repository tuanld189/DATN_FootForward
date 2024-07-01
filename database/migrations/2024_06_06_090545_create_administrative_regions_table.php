<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrativeRegionsTable extends Migration
{
    public function up()
    {
        Schema::create('administrative_regions', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name', 255);
            $table->string('name_en', 255);
            $table->string('code_name', 255)->nullable();
            $table->string('code_name_en', 255)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('administrative_regions');
    }
}
