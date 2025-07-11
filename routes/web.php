<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// =========================
// ✅ Public Frontend Routes
// =========================

// Homepage
Route::get('/', [FrontEndController::class, 'index'])->name('home');

// Search
Route::get('/search', [SearchController::class, 'searchPosts'])->name('search');
Route::get('/search-menu', [SearchController::class, 'searchMenu'])->middleware('auth')->name('search-menu');

// Pages
Route::get('pages/{slug}', [FrontEndController::class, 'showPage'])->name('pages.show');

// Posts
Route::get('posts', [FrontEndController::class, 'allPosts'])->name('allPosts');
Route::get('posts/{slug}', [FrontEndController::class, 'showPost'])->name('posts.show');

// Categories
Route::get('categories/{slug}', [FrontEndController::class, 'showCategories'])->name('categories.show');

// Galleries
Route::get('/galleries', [GalleriesController::class, 'front'])->name('galleries.front');
Route::get('/gallery/{slug}', [GalleriesController::class, 'detail'])->name('gallery.detail');

// Comments
Route::post('comments-post', [CommentsController::class, 'store'])->name('comments.store');

// Language Switcher
Route::get('language/{lang}', [FrontEndController::class, 'switchLang'])->name('lang.switch');


// ===============================
// ✅ Laravel File Manager (Admin)
// ===============================
Route::group(['prefix' => 'cms-opd-ternate-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// =========================
// ✅ Route Group (Modular)
// =========================
require __DIR__ . '/auth.php';
require __DIR__ . '/backend.php';

// Optional debug/api routes (nonaktif jika produksi)
// Route::get('/api/check-update', function () {
//     return response()->json([
//         'version' => '1.2.0',
//         'changelog' => 'Tambah fitur X, fix bug Y',
//         'file_url' => 'https://wahyuumaternate.my.id/resources.zip',
//         'migrate' => true
//     ]);
// });
