<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});    
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
        
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/createPro', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit',[AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{product}',[AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}',[AdminController::class, 'destroyProduct'])->name('products.destroy');

    Route::get('/adminpro', function () {return view('admin.products');})->name('productsadmin');
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
        });
    Route::get('/clients',[AdminController::class, 'clients'])->name('clients');
    Route::patch('/clients/{user}/toggle',    [AdminController::class, 'toggleClient'])->name('clients.toggle');

    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::patch('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.status');

            
});


Route::middleware(['auth', 'role:Client'])->group(function () {

Route::get('/cart',                [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}',     [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{productId}',  [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{productId}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout',[OrderController::class, 'checkout'])->name('order.checkout');
Route::post('/checkout',[OrderController::class, 'store'])->name('order.store');
Route::get('/order/success',[OrderController::class, 'success'])->name('order.success');
Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('order.my');
 
});


require __DIR__.'/auth.php';