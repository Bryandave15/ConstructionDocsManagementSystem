<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

//product modules
//display of products
Route::get('/products', [ProductController::class, 'index'])->name('product_Index');

//route that loads the form
Route::get('/products-add-form', [ProductController::class, 'productAddForm'])->name('product_Add_Form');
//route that recieves data from form
Route::post('/products-save', [ProductController::class, 'productSave'])->name('product_Save');

Route::get('/products-update-form/{product_id}', [ProductController::class, 'productUpdateForm'])->name('product_Update_Form');
Route::post('/products-update', [ProductController::class, 'productUpdate'])->name('product_Update');
Route::post('/products-del', [ProductController::class, 'productDelete'])->name('product_Delete');
Route::get('/product-select/{product_id}', [ProductController::class, 'productSelectOne'])->name('product_Select');

//search
Route::post('/product-search', [ProductController::class, 'productSearch'])->name('product_Search');

//product cart
Route::post('/cart-insert', [CartController::class, 'cartInsert'])->name('cart_Insert');

Route::get('/cart-check', [CartController::class, 'cartCheck'])->name('cart_Check');
Route::get('/cart-clean', [CartController::class, 'cartClean'])->name('cart_Clean');
