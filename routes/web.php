<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/cache', function(){
    Artisan::call('route:clear'); 
    Artisan::call('cache:clear'); 
    Artisan::call('config:clear'); 
    Artisan::call('view:clear'); 
    Artisan::call('config:cache');
    Artisan::call('storage:link');
});

Route::get('/', function () {
    return redirect('/products');
});

Route::get('/dashboard', function () {
    return redirect('/products');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
	Route::get('/products/{product}/buy', [ProductController::class, 'buy'])->name('products.buy');
	Route::post('/products/{product}/charge', [ProductController::class, 'charge'])->name('products.charge');
	Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

	Route::post('/payment-intent/{productId}', [PaymentController::class, 'createPaymentIntent'])->name('payment.intent');
});

require __DIR__.'/auth.php';
