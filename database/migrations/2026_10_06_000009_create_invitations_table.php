<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('branch_id')->nullable()->constrained('company_branches')->nullOnDelete();
            $table->foreignId('job_post_id')->nullable()->constrained('job_posts')->nullOnDelete();
            $table->foreignId('invited_by')->constrained('users')->cascadeOnDelete();
            $table->foreignId('faculty_user_id')->constrained('users')->cascadeOnDelete();
            $table->text('message')->nullable();
            $table->string('status', 20)->default('pending')->index();
            $table->timestamp('expires_at')->nullable()->index();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();
            $table->index(['faculty_user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
