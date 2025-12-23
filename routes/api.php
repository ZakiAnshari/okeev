<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiNewsController;
use App\Http\Controllers\Api\ApiBrandController;
use App\Http\Controllers\Api\ApiContactController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\ApiTestDriveController;

Route::get('/user', function (Request $request) {
    return 'Hello Zaki Selamat Datang Di Okeev';
});

// BRAND API
Route::get('/brands', [ApiBrandController::class, 'index'])->middleware('auth:sanctum');
Route::get('/brands/category/{category_id}', [ApiBrandController::class, 'byCategory'])->middleware('auth:sanctum');

//AUTHENTIFICATION
Route::prefix('auth')->group(function () {
    Route::post('/login', [ApiAuthController::class, 'login']);
    Route::get('/logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');
});

//NEWS
Route::get('/news', [ApiNewsController::class, 'index']);
Route::get('/news/{slug}', [ApiNewsController::class, 'show']);

// PRODUCT
Route::prefix('products')->group(function () {
    // List semua produk (ringkas)
    Route::get('/', [ProductApiController::class, 'index']);

    // Detail produk lengkap berdasarkan slug
    Route::get('/{slug}', [ProductApiController::class, 'show']);

    // Sub-data (opsional jika mau endpoint terpisah)
    Route::get('/{slug}/technologies', [ProductApiController::class, 'technologies']);
    Route::get('/{slug}/features', [ProductApiController::class, 'features']);
    Route::get('/{slug}/colors', [ProductApiController::class, 'colors']);
    Route::get('/{slug}/specifications', [ProductApiController::class, 'specifications']);
    Route::get('/{slug}/powers', [ProductApiController::class, 'powers']);
    Route::get('/{slug}/dimensis', [ProductApiController::class, 'dimensis']);
    Route::get('/{slug}/suspensis', [ProductApiController::class, 'suspensis']);
    Route::get('/{slug}/fiturs', [ProductApiController::class, 'fiturs']);
    Route::get('/{slug}/details', [ProductApiController::class, 'details']);
});

// KONTAK
Route::post('/contacts', [ApiContactController::class, 'store']);

//TEST DRIVE
Route::post('/testdrive', [ApiTestDriveController::class, 'store']);

Route::post('/order/callback',[OrderController::class, 'notificationCallback'])->name('order.callback');