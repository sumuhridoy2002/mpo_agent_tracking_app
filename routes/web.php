<?php

use App\Http\Controllers\{
    DashboardController,
    ProfileController,
    AdminController
};
use Illuminate\Support\Facades\{
    Auth,
    Route
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index']);

Auth::routes(['register' => false]);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth', 'superadmin'])->group(function() {
    # Profile
    Route::prefix('/profile')->name('profile.')->group(function() {
        Route::get('/overview', [ProfileController::class, 'profile'])->name('overview');
        Route::post('/update', [ProfileController::class, 'update'])->name('update');
        Route::post('/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    });

    # Admin CRUD
    Route::resource('/admins', AdminController::class);
});