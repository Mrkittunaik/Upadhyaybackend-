<?php

use App\Support\ApiResponse;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Upadhyay API  —  base path: /api/v1
|--------------------------------------------------------------------------
| Part 1: foundation only (health check).
| Part 2 adds: auth, faculty, company, branch routes.
| Part 3 adds: jobs, applications, invitations, notifications, files, admin.
*/

Route::prefix('v1')->middleware('throttle:api')->group(function () {

    Route::get('/health', fn () => ApiResponse::success([
        'app' => config('app.name'),
        'time' => now()->toIso8601String(),
    ], 'API is running'));

    // ---- Public / auth routes (Part 2) -------------------------------------
    // Route::prefix('auth')->middleware('throttle:auth')->group(...);

    // ---- Authenticated routes ----------------------------------------------
    Route::middleware('auth:sanctum')->group(function () {
        // Route::get('/auth/me', ...);

        // Role-protected groups (examples, filled in later parts):
        // Route::middleware('role:admin')->prefix('admin')->group(...);
        // Route::middleware('role:faculty')->prefix('faculty')->group(...);
        // Route::middleware('role:company_main,company_branch')->group(...);
    });
});
