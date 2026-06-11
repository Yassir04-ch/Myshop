<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

Route::get('/',[ProductController::class, 'home']);  
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.edit');
    Route::get('/my-profile',[ProfileController::class, 'edit'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/rewards', [ProductController::class, 'index'])->name('rewards.index');
});
        
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::middleware(['auth', 'role:Admin'])->group(function () {

    // Products
    Route::get('/createPro', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::delete('/images/{image}', [ProductController::class, 'destroyImage'])->name('images.destroy');

    // Categories -- b prefix sahi
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // Admin
    Route::get('/adminpro', [AdminController::class, 'products'])->name('productsadmin');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Clients
    Route::get('/clients', [AdminController::class, 'clients'])->name('clients');
    Route::patch('/clients/{user}/toggle', [AdminController::class, 'toggleClient'])->name('clients.toggle');
    Route::put('/activerClient/{user}', [AdminController::class, 'activerClient'])->name('admin.clients.activer');
    Route::put('/desactiverClient/{user}', [AdminController::class, 'desactiverClient'])->name('admin.clients.desactiver');

    // Orders
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::patch('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.status');
    Route::get('/orders/{order}', [OrderController::class, 'showOrder'])->name('orders.show');

});


Route::middleware(['auth', 'role:Client'])->group(function () {

    // Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{productId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{productId}', [CartController::class, 'remove'])->name('cart.remove');

    // Orders
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('order.my');

    // Points
    Route::post('/product/{id}/buy-points', [OrderController::class, 'buyWithPoints'])->name('product.buy.points');

});


require __DIR__.'/auth.php';