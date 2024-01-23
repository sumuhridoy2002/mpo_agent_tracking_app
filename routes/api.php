<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\{
    ProfileController,
    NotFoundController,
    DashboardController,
    AgentController,
    DoctorController,
    TestController,
    TargetController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider, and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

# Check the server is live or died
Route::get('/server-lifetime-check', fn() => "Server is giving APIs perfectly.");

# Hridoy
Route::prefix('/v1')->group(function() {
    
    # APIs for App (MPO agent)
    Route::prefix('/app')->group(function() {
        # Login
        Route::post('/login', [AuthController::class, 'login']);

        # Resend OTP
        Route::post('/resend-otp', [AuthController::class, 'resendOTP']);

        # Verify OTP
        Route::post('/verify-otp', [AuthController::class, 'verifyOTP']);

        # Forgot Password
        Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);

        # Reset Password OTP matching
        Route::post('/reset-password-otp-match', [AuthController::class, 'resetPasswordOTPMatch']);

        # Reset Password
        Route::post('/reset-password', [AuthController::class, 'resetPassword']);

        Route::group(['middleware' => ['auth:sanctum', 'agent']], function () {
            # Logout
            Route::post('/logout', [AuthController::class, 'logout']);

            # Authenticate user profile data
            Route::get('/me', [ProfileController::class, 'get_profile']);

            # Update profile data
            Route::post('/update-profile', [ProfileController::class, 'update_profile']);

            # Update profile avatar
            Route::post('/update-avatar', [ProfileController::class, 'update_avatar']);

            # Update profile NID
            Route::post('/update-nid', [ProfileController::class, 'update_nid']);

            # Update profile passport
            Route::post('/update-passport', [ProfileController::class, 'update_passport']);

            # Dashboard Data
            Route::get('/dashboard-data', [DashboardController::class, 'get_dashboard_data']);
        });
    });

    # APIs for ERP (Amin diagnostic)
    Route::prefix('/erp')->group(function() {
        # Login
        Route::post('/login', [AuthController::class, 'login']); // Not completed
        
        Route::group(['middleware' => ['auth:sanctum', 'admin']], function () { // Not completed
            # Logout
            Route::post('/logout', [AuthController::class, 'logout']); // Not completed

            # Agents, Doctors, Tests CRUD
            Route::apiResources([
                '/agents' => AgentController::class, // Not completed
                '/doctors' => DoctorController::class, // Not completed
                '/tests' => TestController::class // Not completed
            ]);

            # Target
            Route::post('/targets/store', [TargetController::class, 'store']);
        });
    });
});

Route::fallback([NotFoundController::class, 'handle']);