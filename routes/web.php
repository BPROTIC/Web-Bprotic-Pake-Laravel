<?php

use App\Http\Controllers\Admin\AdminAchievementController;
use App\Http\Controllers\Admin\AdminActivityController;
use App\Http\Controllers\Admin\AdminArticleController;
use App\Http\Controllers\Admin\AdminContactMessageController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDepartmentController;
use App\Http\Controllers\Admin\AdminDepartmentFieldController;
use App\Http\Controllers\Admin\AdminDivisionController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\PublicAchievementController;
use App\Http\Controllers\Public\PublicActivityController;
use App\Http\Controllers\Public\PublicArticleController;
use App\Http\Controllers\Public\PublicDepartmentController;
use App\Http\Controllers\Public\PublicDivisionController;
use App\Http\Controllers\Public\PublicGalleryController;
use App\Http\Controllers\Public\PublicPageController;
use App\Http\Controllers\Public\PublicProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Akses Pengunjung Umum)
|--------------------------------------------------------------------------
*/
Route::name('public.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/tentang-kami', [PublicPageController::class, 'about'])->name('about');

    Route::get('/departemen', [PublicDepartmentController::class, 'index'])->name('departments.index');
    Route::get('/departemen/{slug}', [PublicDepartmentController::class, 'show'])->name('departments.show');

    // Backward compatibility for /divisi
    Route::get('/divisi', [PublicDivisionController::class, 'index'])->name('divisions.index');
    Route::get('/divisi/{slug}', [PublicDivisionController::class, 'show'])->name('divisions.show');

    Route::get('/kegiatan', [PublicActivityController::class, 'index'])->name('activities.index');
    Route::get('/kegiatan/{slug}', [PublicActivityController::class, 'show'])->name('activities.show');

    Route::get('/artikel', [PublicArticleController::class, 'index'])->name('articles.index');
    Route::get('/artikel/{slug}', [PublicArticleController::class, 'show'])->name('articles.show');

    Route::get('/prestasi', [PublicAchievementController::class, 'index'])->name('achievements.index');
    Route::get('/galeri', [PublicGalleryController::class, 'index'])->name('galleries.index');
    Route::get('/produk', [PublicProductController::class, 'index'])->name('products.index');

    Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
    Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

    Route::get('/halaman/{slug}', [PublicPageController::class, 'show'])->name('pages.show');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Protected Routes (Hanya Administrator Terautentikasi)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', fn () => redirect()->route('admin.dashboard'));
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('kegiatan', AdminActivityController::class)
            ->parameters(['kegiatan' => 'activity'])
            ->names('activities');

        Route::resource('artikel', AdminArticleController::class)
            ->parameters(['artikel' => 'article'])
            ->names('articles');

        Route::resource('prestasi', AdminAchievementController::class)
            ->parameters(['prestasi' => 'achievement'])
            ->names('achievements');

        Route::resource('galeri', AdminGalleryController::class)
            ->parameters(['galeri' => 'gallery'])
            ->names('galleries');

        Route::resource('produk', AdminProductController::class)
            ->parameters(['produk' => 'product'])
            ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
            ->names('products');

        Route::resource('departemen', AdminDepartmentController::class)
            ->parameters(['departemen' => 'department'])
            ->names('departments');

        Route::post('departemen/{department}/bidang', [AdminDepartmentFieldController::class, 'store'])
            ->name('departments.fields.store');
        Route::put('departemen/bidang/{field}', [AdminDepartmentFieldController::class, 'update'])
            ->name('departments.fields.update');
        Route::delete('departemen/bidang/{field}', [AdminDepartmentFieldController::class, 'destroy'])
            ->name('departments.fields.destroy');

        // Backward compatibility for /admin/divisi
        Route::get('divisi', fn () => redirect()->route('admin.departments.index'))->name('divisions.index');

        Route::resource('halaman', AdminPageController::class)
            ->parameters(['halaman' => 'page'])
            ->names('pages');

        Route::resource('pesan', AdminContactMessageController::class)
            ->parameters(['pesan' => 'contactMessage'])
            ->only(['index', 'show', 'destroy'])
            ->names('contact-messages');

        Route::get('/pengaturan', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::put('/pengaturan', [AdminSettingController::class, 'update'])->name('settings.update');

        Route::resource('pengguna', AdminUserController::class)
            ->parameters(['pengguna' => 'user'])
            ->names('users');
    });
