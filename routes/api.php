<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ContenidoController;
use App\Http\Controllers\Admin\OrdenController;
use App\Http\Controllers\Admin\ProductsRenderController;

use App\Http\Controllers\ApiperuController;
use App\Http\Controllers\AsignacionConversionesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleAdPerformanceController;
use App\Http\Controllers\GoogleAdsConversionController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MereyController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PeticionesController;
use App\Http\Controllers\PrecioEnvioController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegistroVentasManualController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TagController;
use App\Models\Category;
use App\Models\Index;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Modules\Crm\Http\Controllers\Messages2Controller;
use Modules\Crm\Http\Controllers\MessagesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('apikey')->group(function () {

    // Route::post('/crm/MESSAGES_UPSERT', [Messages2Controller::class, 'messageUpsert']);
});



Route::post('/google-ads/sync', [GoogleAdsConversionController::class, 'sync']);

Route::middleware(['web', 'auth:sanctum', 'verified'])->group(function () {
    Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect']);
});
