<?php

use App\Http\Controllers\{HomeController, LanguageController, ProductController, UserController, AdminController};
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function(){
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'dashboard'], function () {
        Route::prefix('admins')->group(function () {
            Route::get('index', [AdminController::class, 'index'])->name('admins.index');
            Route::get('create', [AdminController::class, 'create'])->name('admins.create');
            Route::post('create', [AdminController::class, 'store'])->name('admins.store');
            Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admins.edit');
            Route::post('update', [AdminController::class, 'update'])->name('admins.update');
            Route::post('delete/{id}', [AdminController::class, 'destroy'])->name('admins.delete');
        });

        Route::prefix('users')->group(function () {
            Route::get('index', [UserController::class, 'index'])->name('users.index');
            Route::get('create', [UserController::class, 'create'])->name('users.create');
            Route::post('create', [UserController::class, 'store'])->name('users.store');
            Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit');
            Route::post('update', [UserController::class, 'update'])->name('users.update');
            Route::post('delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
        });

        Route::prefix('products')->group(function () {
            Route::get('index', [ProductController::class, 'index'])->name('products.index');
            Route::get('create', [ProductController::class, 'create'])->name('products.create');
            Route::post('create', [ProductController::class, 'store'])->name('products.store');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
            Route::post('update', [ProductController::class, 'update'])->name('products.update');
            Route::post('delete/{id}', [ProductController::class, 'destroy'])->name('products.delete');
        });

        Route::prefix('languages')->group(function () {
            Route::get('index', [LanguageController::class, 'index'])->name('languages.index');
            Route::get('create', [LanguageController::class, 'create'])->name('languages.create');
            Route::post('create', [LanguageController::class, 'store'])->name('languages.store');
            Route::get('edit/{id}', [LanguageController::class, 'edit'])->name('languages.edit');
            Route::post('update', [LanguageController::class, 'update'])->name('languages.update');
            Route::post('delete/{id}', [LanguageController::class, 'destroy'])->name('languages.delete');
        });
    });
});
