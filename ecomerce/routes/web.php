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
        
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/createPro', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit',[ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}',[ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}',[ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/adminpro',[AdminController::class,'products'])->name('productsadmin');
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::get('/clients',[AdminController::class, 'clients'])->name('clients');
    Route::patch('/clients/{user}/toggle',    [AdminController::class, 'toggleClient'])->name('clients.toggle');

    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::patch('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.status');

    Route::get('/clients',[AdminController::class,'clients'])->name('clients');
    Route::get('/orderShow',[OrderController::class,'showOrder'])->name('orders.show');
    Route::put('/activerClient/{user}', [AdminController::class, 'activerClient'])->name('admin.clients.activer');
    Route::put('/desactiverClient/{user}', [AdminController::class, 'desactiverClient'])->name('admin.clients.desactiver');
            
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