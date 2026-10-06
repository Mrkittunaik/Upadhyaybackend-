<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_user_id')->constrained('users')->cascadeOnDelete();
            $table->string('name')->index();
            $table->string('company_code', 20)->nullable()->unique();
            $table->string('verification_status', 20)->default('unverified')->index();
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->unique()->constrained()->cascadeOnDelete();
            $table->foreignId('logo_file_id')->nullable()->constrained('files')->nullOnDelete();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('industry', 120)->nullable();
            $table->string('address')->nullable();
            $table->string('city', 100)->nullable()->index();
            $table->string('city_code', 10)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_profiles');
        Schema::dropIfExists('companies');
    }
};
