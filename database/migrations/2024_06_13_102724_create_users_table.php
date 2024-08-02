<?php

use App\Models\AddressDetail;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fullname', 50)->unique();
            $table->string('phone', 20)->nullable();
            $table->string('province_code', 20)->nullable();
            $table->string('district_code', 20)->nullable();
            $table->string('wand_code', 20)->nullable();
            $table->string('address')->nullable();
            $table->dateTime('birthday')->nullable();
            $table->string('photo_thumbs')->nullable();
            $table->longText('status')->nullable();
            $table->string('email')->unique();
            $table->string('user_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(true);
            // $table->boolean('is_admin')->default(false); // 0=user, 1=admin, 2=manager
            $table->rememberToken();
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('province_code')->references('code')->on('provinces')->onDelete('set null');
            $table->foreign('district_code')->references('code')->on('districts')->onDelete('set null');
            $table->foreign('wand_code')->references('code')->on('wards')->onDelete('set null'); // Changed 'wands' to 'wards'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
