<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleAuthController;
use Illuminate\Support\Facades\Route;
use App\Models\AboutUs;
use App\Models\Price;
use Inertia\Inertia;
use App\Models\General;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

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

/* Las rutas publicas */

Route::get('/google-callback', [GoogleAuthController::class, 'callback']);


Route::middleware(['auth:sanctum', 'verified', 'can:Admin'])->group(function () {

  Route::prefix('admin')->group(function () {

    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'reactView'])->name('Admin/Dashboard.jsx');
  });
});
