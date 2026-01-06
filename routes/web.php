<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FiturController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DimensiController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeUserController;
use App\Http\Controllers\SuspensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestDriveController;
use App\Http\Middleware\DetectMobileRedirect;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Mobile\DriveController;
use App\Http\Controllers\SpecificationController;

Route::middleware(['role_not_one', DetectMobileRedirect::class])->group(function () {
    Route::get('/', [LandingPageController::class, 'index'])->name('landing');
    Route::get('/brand/{slug}', [LandingPageController::class, 'showBrand'])->name('landing.cars');
    Route::get('/product/{productSlug}', [LandingPageController::class, 'showProduct'])->name('landing.product');

    Route::get('/contact', [LandingPageController::class, 'contact'])->name('contact');
    Route::get('/about', [LandingPageController::class, 'about'])->name('about');
    Route::get('/News', [LandingPageController::class, 'newss'])->name('newss');
    Route::get('/News/{slug}', [LandingPageController::class, 'newsDetail'])->name('News.detail');

    Route::get('/cart', [LandingPageController::class, 'cart'])->name('cart');
    Route::get('/contact', [LandingPageController::class, 'contact'])->name('contact');
    Route::post('/contact-add', [LandingPageController::class, 'stores'])->name('contact.store');
});

Route::middleware('redirectIfAuth')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticating']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerprocess'])->name('register-store');
});

// AKSES USER PERLU LOGIN
Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/home', [HomeUserController::class, 'index']);
    Route::get('/profil/{slug}', [HomeUserController::class, 'showProfile'])->name('profil.show');
    Route::post('/profil-add', [HomeUserController::class, 'profilestore'])->name('profilestore.store');

    Route::get('/product/{productSlug}/testdrive', [LandingPageController::class, 'testdrive'])->name('landing.product.testdrive');
    Route::post('/product/{productSlug}/testdrive-add', [LandingPageController::class, 'store'])->name('testdrive.store');

    Route::get('/cart', [HomeUserController::class, 'cart'])->name('cart');
    Route::post('/cart/add', [HomeUserController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/increase', [HomeUserController::class, 'increaseQty']);
    Route::post('/cart/decrease', [HomeUserController::class, 'decreaseQty']);
    Route::delete('/cart/{id}', [HomeUserController::class, 'removeItem']);

    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');

    Route::get('/order/{product:slug}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/order/{product:slug}/invoice', [OrderController::class, 'createInvoice'])->name('order.invoice');



    Route::get('/payment/va/{order}', [PaymentController::class, 'virtualAccount'])
        ->name('payment.va');

    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
});


//ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
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
    Route::get('/get-brands/{category_id}', [BrandController::class, 'getBrandsByCategory']);
    // CATEGORY
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category-add', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{slug}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/{slug}/edit', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/category-destroy/{slug}', [CategoryController::class, 'destroy'])->name('category.destroy');
    // TEST DRIVE
    Route::get('/test-drive', [TestDriveController::class, 'index'])->name('testdrive.index');
    Route::get('/test-drive-show/{id}', [TestDriveController::class, 'show'])->name('testdrive.show');
    Route::get('/test-drive-destroy/{id}', [TestDriveController::class, 'destroy'])->name('testdrive.destroy');
    //PRODUK
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product-add', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{slug}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/{slug}/edit', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product-destroy/{slug}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('/product-show/{slug}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/get-brands/{category_id}', [ProductController::class, 'getBrands']);
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

    //POWER
    Route::get('/product/{slug}/powers', [PowerController::class, 'index'])->name('powers.index');
    Route::post('/product-add/{slug}/powers', [PowerController::class, 'store'])->name('powers.store');
    Route::get('/product/{product_slug}/powers/{id}/edit', [PowerController::class, 'edit'])->name('powers.edit');
    Route::post('/product/{product_slug}/powers/{id}/edit', [PowerController::class, 'update'])->name('powers.update');
    Route::get('/product/{product_slug}/powers/{powers}', [PowerController::class, 'destroy'])->name('powers.destroy');

    //DIMENSI
    Route::get('/product/{slug}/dimensis', [DimensiController::class, 'index'])->name('dimensis.index');
    Route::post('/product-add/{slug}/dimensis', [DimensiController::class, 'store'])->name('dimensis.store');
    Route::get('/product/{product_slug}/dimensis/{id}/edit', [DimensiController::class, 'edit'])->name('dimensis.edit');
    Route::post('/product/{product_slug}/dimensis/{id}/edit', [DimensiController::class, 'update'])->name('dimensis.update');
    Route::get('/product/{product_slug}/dimensis/{dimensis}', [DimensiController::class, 'destroy'])->name('dimensis.destroy');

    //SUSPENSI
    Route::get('/product/{slug}/suspensis', [SuspensiController::class, 'index'])->name('suspensis.index');
    Route::post('/product-add/{slug}/suspensis', [SuspensiController::class, 'store'])->name('suspensis.store');
    Route::get('/product/{product_slug}/suspensis/{id}/edit', [SuspensiController::class, 'edit'])->name('suspensis.edit');
    Route::post('/product/{product_slug}/suspensis/{id}/edit', [SuspensiController::class, 'update'])->name('suspensis.update');
    Route::get('/product/{product_slug}/suspensis/{suspensis}', [SuspensiController::class, 'destroy'])->name('suspensis.destroy');

    //FITUR
    Route::get('/product/{slug}/fiturs', [FiturController::class, 'index'])->name('fiturs.index');
    Route::post('/product-add/{slug}/fiturs', [FiturController::class, 'store'])->name('fiturs.store');
    Route::get('/product/{product_slug}/fiturs/{id}/edit', [FiturController::class, 'edit'])->name('fiturs.edit');
    Route::post('/product/{product_slug}/fiturs/{id}/edit', [FiturController::class, 'update'])->name('fiturs.update');
    Route::get('/product/{product_slug}/fiturs/{fiturs}', [FiturController::class, 'destroy'])->name('fiturs.destroy');

    //DETAIL
    Route::get('/product/{slug}/details', [DetailController::class, 'index'])->name('details.index');
    Route::post('/product-add/{slug}/details', [DetailController::class, 'store'])->name('details.store');
    Route::get('/product/{product_slug}/details/{id}/edit', [DetailController::class, 'edit'])->name('details.edit');
    Route::post('/product/{product_slug}/details/{id}/edit', [DetailController::class, 'update'])->name('details.update');
    Route::get('/product/{product_slug}/details/{details}', [DetailController::class, 'destroy'])->name('details.destroy');
    // --------------------
    // ORDER
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    // --------------------
    //NEWS
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::post('/news-add', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{slug}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::post('/news/{slug}/edit', [NewsController::class, 'update'])->name('news.update');
    Route::get('/news-destroy/{slug}', [NewsController::class, 'destroy'])->name('news.destroy');
    // KONTAK
    Route::get('/Contact', [ContactController::class, 'index'])->name('Contact.index');
    Route::post('/Contact-add', [ContactController::class, 'store'])->name('Contact.store');
    Route::get('/Contact-destroy/{id}', [ContactController::class, 'destroy'])->name('Contact.destroy');
    Route::get('/Contact-show/{id}', [ContactController::class, 'show'])->name('Contact.show');
    // USER
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user-add', [UserController::class, 'store'])->name('user.store');
    Route::get('/user-edit/{id}', [UserController::class, 'edit']);
    Route::post('/user-edit/{id}', [UserController::class, 'update']);
    Route::get('/user-destroy/{id}', [UserController::class, 'destroy']);
    Route::get('/user-show/{id}', [UserController::class, 'show'])->name('user.show');
});

// MOBILE ---------------------------------------------------------------------------------------------------------------------
Route::prefix('m')->middleware([DetectMobileRedirect::class])->group(function () {
    Route::get('/', [App\Http\Controllers\Mobile\HomeController::class, 'index'])->name('mobile.home');

    Route::get('/vehiclecard', [App\Http\Controllers\Mobile\HomeController::class, 'showcard'])->name('vehiclecard.show');
    Route::get('/vehiclemotorcycles', [App\Http\Controllers\Mobile\HomeController::class, 'showmotorcycles'])->name('showmotorcycles.show');
    Route::get('/electric', [App\Http\Controllers\Mobile\HomeController::class, 'showelectric'])->name('showelectric.show');
    Route::get('/accessories', [App\Http\Controllers\Mobile\HomeController::class, 'showaccessories'])->name('showaccessories.show');

    Route::get('/vehicle/brand/{slug}', [App\Http\Controllers\Mobile\HomeController::class, 'showBrandVehicle'])->name('vehiclecard.detail');
    Route::get('/vehiclemotor/brand/{slug}', [App\Http\Controllers\Mobile\HomeController::class, 'showBrandmotor'])->name('vehiclemotor.detail');
    Route::get('/electric/brand/{slug}', [App\Http\Controllers\Mobile\HomeController::class, 'showBrandelectric'])->name('electric.detail');
    Route::get('/accessories/brand/{slug}', [App\Http\Controllers\Mobile\HomeController::class, 'showBrandaccessories'])->name('accessories.detail');

    Route::get('/product/{productSlug}', [App\Http\Controllers\Mobile\HomeController::class, 'showVehicleDetail'])->name('vehiclecard.product');

    Route::get('/product/{productSlug}/drive', [DriveController::class, 'index'])->name('drive.index');
    Route::post('/product/{productSlug}/testdrive-add', [DriveController::class, 'store'])->name('drive.store');

    Route::get('/order/{product:slug}', [App\Http\Controllers\Mobile\OrderController::class, 'show'])->name('order.show');
    Route::post('/order/{product:slug}/invoice', [App\Http\Controllers\Mobile\OrderController::class, 'createInvoice'])->name('order.invoice');

    Route::get('/payment/va/{order}', [App\Http\Controllers\Mobile\PaymentController::class, 'virtualAccount'])
        ->name('payment.vam');


    Route::get('/transaksi', [App\Http\Controllers\Mobile\HomeController::class, 'transaksi'])->name('transaksi.show');

    Route::get('/newss', [App\Http\Controllers\Mobile\HomeController::class, 'newss'])->name('newss.show');
    Route::get('/newss/detail', [App\Http\Controllers\Mobile\HomeController::class, 'newssdetail'])->name('newssdetail.show');

    Route::get('/profilm', [App\Http\Controllers\Mobile\HomeController::class, 'profilm'])->name('profilm.show');

    Route::get('/about', [App\Http\Controllers\Mobile\HomeController::class, 'about'])->name('about.show');

    Route::get('/contact', [App\Http\Controllers\Mobile\HomeController::class, 'contact'])->name('contact.index');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/login', [App\Http\Controllers\Mobile\LoginController::class, 'index'])->name('login.index');
    Route::post('/login', [App\Http\Controllers\Mobile\LoginController::class, 'mobileauthenticating']);
    // LOGOUT
    Route::post('/logout', [App\Http\Controllers\Mobile\LoginController::class, 'logout'])
        ->name('mobile.logout');
});
