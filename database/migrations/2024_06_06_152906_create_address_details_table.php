<?php

use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
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
        Schema::create('address_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Province::class)->constrained();
            $table->foreignIdFor(District::class)->constrained();
            $table->foreignIdFor(Ward::class)->constrained();
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address_details');
    }
};
