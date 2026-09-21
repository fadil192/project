<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CtaSectionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\PageSectionController;
use App\Http\Controllers\Admin\PromoProductController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.attempt');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/hero', [HeroController::class, 'edit'])->name('hero.edit');
        Route::put('/hero', [HeroController::class, 'update'])->name('hero.update');

        Route::get('/sections', [PageSectionController::class, 'index'])->name('sections.index');
        Route::get('/sections/{section}/edit', [PageSectionController::class, 'edit'])->name('sections.edit');
        Route::put('/sections/{section}', [PageSectionController::class, 'update'])->name('sections.update');

        Route::resource('products', PromoProductController::class)
            ->parameters(['products' => 'product'])
            ->except(['show']);
        Route::patch('/products/{product}/toggle', [PromoProductController::class, 'toggle'])->name('products.toggle');

        Route::get('/cta', [CtaSectionController::class, 'index'])->name('cta.index');
        Route::get('/cta/{cta}/edit', [CtaSectionController::class, 'edit'])->name('cta.edit');
        Route::put('/cta/{cta}', [CtaSectionController::class, 'update'])->name('cta.update');

        Route::get('/social', [SocialLinkController::class, 'index'])->name('social.index');
        Route::post('/social', [SocialLinkController::class, 'store'])->name('social.store');
        Route::get('/social/{social}/edit', [SocialLinkController::class, 'edit'])->name('social.edit');
        Route::put('/social/{social}', [SocialLinkController::class, 'update'])->name('social.update');
        Route::delete('/social/{social}', [SocialLinkController::class, 'destroy'])->name('social.destroy');
        Route::patch('/social/{social}/toggle', [SocialLinkController::class, 'toggle'])->name('social.toggle');

        Route::get('/contact', [ContactController::class, 'edit'])->name('contact.edit');
        Route::put('/contact', [ContactController::class, 'update'])->name('contact.update');

        Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
});