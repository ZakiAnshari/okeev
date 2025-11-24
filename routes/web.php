<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\SpecificationController;

Route::middleware('guest')->group(function () {
    Route::get('/', [LandingPageController::class, 'index'])->name('landing');
    Route::get('/wuling', [LandingPageController::class, 'wuling'])->name('wuling');
    Route::get('/detailwuling', [LandingPageController::class, 'detailwuling'])->name('detailwuling');
    Route::get('/testdrive', [LandingPageController::class, 'testdrive'])->name('testdrive');
    Route::get('/cart', [LandingPageController::class, 'cart'])->name('cart');
    Route::get('/contact', [LandingPageController::class, 'contact'])->name('contact');
    //Login
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticating']);
});

//ADMIN
Route::middleware(['auth'])->group(function () {
    // LOGOUT
    Route::get('/logout', [AuthController::class, 'logout']);
    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // BRANDS
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::post('/brands-add', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/brands/{slug}/edit', [BrandController::class, 'edit'])->name('brands.edit');
    Route::post('/brands/{slug}/edit', [BrandController::class, 'update'])->name('brands.update');
    Route::get('/brands-destroy/{slug}', [BrandController::class, 'destroy'])->name('brands.destroy');
    // CATEGORY
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category-add', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{slug}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/{slug}/edit', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category-destroy/{slug}', [CategoryController::class, 'destroy'])->name('category.destroy');
    //PRODUK
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product-add', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{slug}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/{slug}/edit', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product-destroy/{slug}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product-show/{slug}', [ProductController::class, 'show'])->name('product.show');
    //technologies
    Route::get('/product/{slug}/technologies', [TechnologyController::class, 'index'])->name('technologies.index');
    Route::post('/product-add/{slug}/technologies', [TechnologyController::class, 'store'])->name('technologies.store');
    Route::get('/product/{product_slug}/technologies/{id}/edit', [TechnologyController::class, 'edit'])->name('technologies.edit');
    Route::post('/product/{product_slug}/technologies/{id}/edit', [TechnologyController::class, 'update'])->name('technologies.update');
    Route::get('/product/{product_slug}/technologies/{technologies}', [TechnologyController::class, 'destroy'])->name('technologies.destroy');
    //FEATURE
    Route::get('/product/{slug}/features', [FeatureController::class, 'index'])->name('features.index');
    Route::post('/product-add/{slug}/features', [FeatureController::class, 'store'])->name('features.store');
    Route::get('/product/{product_slug}/features/{id}/edit', [FeatureController::class, 'edit'])->name('features.edit');
    Route::post('/product/{product_slug}/features/{id}/edit', [FeatureController::class, 'update'])->name('features.update');
    Route::get('/product/{product_slug}/features/{features}', [FeatureController::class, 'destroy'])->name('features.destroy');
    //COLOR
    Route::get('/product/{slug}/colors', [ColorController::class, 'index'])->name('colors.index');
    Route::post('/product-add/{slug}/colors', [ColorController::class, 'store'])->name('colors.store');
    Route::get('/product/{product_slug}/colors/{id}/edit', [ColorController::class, 'edit'])->name('colors.edit');
    Route::post('/product/{product_slug}/colors/{id}/edit', [ColorController::class, 'update'])->name('colors.update');
    Route::get('/product/{product_slug}/colors/{colors}', [ColorController::class, 'destroy'])->name('colors.destroy');
    //SPECIFICATION
    Route::get('/product/{slug}/specifications', [SpecificationController::class, 'index'])->name('specifications.index');
    Route::post('/product-add/{slug}/specifications', [SpecificationController::class, 'store'])->name('specifications.store');
    Route::get('/product/{product_slug}/specifications/{id}/edit', [SpecificationController::class, 'edit'])->name('specifications.edit');
    Route::post('/product/{product_slug}/specifications/{id}/edit', [SpecificationController::class, 'update'])->name('specifications.update');
    Route::get('/product/{product_slug}/specifications/{specifications}', [SpecificationController::class, 'destroy'])->name('specifications.destroy');



















































    // // Electric Cars
    // Route::get('/cars', [ElectricCarsController::class, 'index'])->name('cars.index');
    // Route::post('/cars-add', [ElectricCarsController::class, 'store'])->name('cars.store');
    // Route::get('/cars-edit/{id}', [ElectricCarsController::class, 'edit']);
    // Route::post('/cars-edit/{id}', [ElectricCarsController::class, 'update']);
    // Route::get('/cars-show/{id}', [ElectricCarsController::class, 'show'])->name('cars.show');
    // Route::get('/cars-destroy/{id}', [ElectricCarsController::class, 'destroy']);
    // // TEKNOLOGI CARS
    // Route::get('/cars/{electric_car}/technologies', [TechnologyCarController::class, 'index'])->name('technologies.index');
    // Route::post('/cars/{electric_car}/technologies-add', [TechnologyCarController::class, 'store'])->name('technologies.store');
    // Route::get('/cars/{electric_car}/technologies/{technology}/edit', [TechnologyCarController::class, 'edit'])->name('technologies.edit');
    // Route::put('/cars/{electric_car}/technologies/{technology}', [TechnologyCarController::class, 'update'])->name('technologies.update');
    // Route::get('/cars/{electric_car}/technologies/{technology}', [TechnologyCarController::class, 'destroy'])->name('technologies.destroy');
    // // FEATURE CARS
    // Route::get('/cars/{electric_car}/features', [FeatureController::class, 'index'])->name('features.index');
    // Route::post('/cars/{electric_car}/features-add', [FeatureController::class, 'store'])->name('features.store');
    // Route::get('/cars/{electric_car}/features/{features}/edit', [FeatureController::class, 'edit'])->name('features.edit');
    // Route::put('/cars/{electric_car}/features/{features}', [FeatureController::class, 'update'])->name('features.update');
    // Route::get('/cars/{electric_car}/features/{features}', [FeatureController::class, 'destroy'])->name('features.destroy');
    // // COLOR
    // Route::get('/cars/{electric_car}/color', [ColorController::class, 'index'])->name('colors.index');
    // Route::post('/cars/{electric_car}/color-add', [ColorController::class, 'store'])->name('colors.store');
    // Route::get('/cars/{electric_car}/color/{colors}/edit', [ColorController::class, 'edit'])->name('colors.edit');
    // Route::put('/cars/{electric_car}/color/{colors}', [ColorController::class, 'update'])->name('colors.update');
    // Route::get('/cars/{electric_car}/color/{colors}', [ColorController::class, 'destroy'])->name('colors.destroy');
    // // SPECIFICATION
    // Route::get('/cars/{electric_car}/specifications', [SpecifitionController::class, 'index'])->name('specifications.index');
    // Route::post('/cars/{electric_car}/specifications-add', [SpecifitionController::class, 'store'])->name('specifications.store');
    // Route::get('/cars/{electric_car}/specifications/{specifications}/edit', [SpecifitionController::class, 'edit'])->name('specifications.edit');
    // Route::put('/cars/{electric_car}/specifications/{specifications}', [SpecifitionController::class, 'update'])->name('specifications.update');
    // Route::get('/cars/{electric_car}/specifications/{specifications}', [SpecifitionController::class, 'destroy'])->name('specifications.destroy');






















    // USER
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user-add', [UserController::class, 'store'])->name('user.store');
    Route::get('/user-edit/{id}', [UserController::class, 'edit']);
    Route::post('/user-edit/{id}', [UserController::class, 'update']);
    Route::get('/user-destroy/{id}', [UserController::class, 'destroy']);
    Route::get('/user-show/{id}', [UserController::class, 'show'])->name('user.show');
});
