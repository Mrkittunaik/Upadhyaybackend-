<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branch_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // requesting branch user
            $table->string('branch_name');
            $table->string('location')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('city_code', 10)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('status', 20)->default('pending');
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->string('rejection_reason')->nullable();
            $table->timestamps();
            $table->index(['company_id', 'status']);
            $table->index(['user_id', 'status']);
        });

        Schema::create('company_branches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_request_id')->nullable()->constrained('branch_requests')->nullOnDelete();
            $table->char('branch_code', 5)->nullable()->unique(); // set by backend on approval
            $table->string('branch_name');
            $table->string('location')->nullable();
            $table->string('city', 100)->nullable()->index();
            $table->string('city_code', 10)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('status', 20)->default('pending')->index();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['company_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_branches');
        Schema::dropIfExists('branch_requests');
    }
};
