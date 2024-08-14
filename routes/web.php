<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CompanyProfileController;

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

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/about-me', [FrontController::class, 'aboutMe'])->name('about-me');
Route::get('/{slug}', [FrontController::class, 'articles'])->name('articles');
Route::get('/{categorySlug}/article/{slug}', [FrontController::class, 'article'])->name('article');

Route::prefix('admin')->name('admin.')->group(function(){
    Route::middleware(['web', 'disableBackButton'])->group(function(){
        Route::middleware(['disableRedirectToLoginPage'])->group(function(){
            Route::get('login', [AuthenticationController::class, 'login'])->name('login');
            Route::post('post/login', [AuthenticationController::class, 'postLogin'])->name('post.login');
        });
        
        Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');
    });

    Route::middleware(['auth:web', 'disableBackButton', 'admin'])->group(function(){
        Route::resource('company-profile', CompanyProfileController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('article', ArticleController::class);
    });
});
