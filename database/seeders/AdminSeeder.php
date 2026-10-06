<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\AdminUser;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('production')) {
            $this->command?->warn('AdminSeeder skipped in production. Create the admin manually.');

            return;
        }

        $password = env('SEED_ADMIN_PASSWORD') ?: Str::random(16);

        $user = User::firstOrCreate(
            ['email' => env('SEED_ADMIN_EMAIL', 'admin@upadhyay.local')],
            ['name' => 'Admin', 'password' => $password, 'role' => UserRole::Admin, 'status' => UserStatus::Active],
        );

        AdminUser::firstOrCreate(['user_id' => $user->id], ['is_super' => true]);

        if ($user->wasRecentlyCreated) {
            $this->command?->info("Dev admin: {$user->email} / {$password}  (development only!)");
        }
    }
}
