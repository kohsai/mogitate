<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/test', function() {
    return view('test');
});



// 商品一覧
Route::get('/products',[ProductController::class, 'index'])->name('products.index');

// 商品登録（フォーム表示）
Route::get('/products/register', [ProductController::class, 'create'])->name('products.create');

// 商品登録（登録処理）
Route::post('/products/register', [ProductController::class, 'store'])->name('products.store');

// 商品検索
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

// 商品更新（フォーム表示）
Route::get('/products/{productId}/update', [ProductController::class, 'edit'])->name('products.edit');

// 商品更新（更新処理）
Route::post('/products/{productId}/update', [ProductController::class, 'update'])->name('products.update');

// 商品削除
Route::post('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('products.destroy');


// 商品詳細
Route::get('/products/{productId}', [ProductController::class, 'show'])->name('products.show');
