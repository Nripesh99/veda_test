<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');
;



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    // Route::get('/adduser', function () {
        //     return view('auth.register');
        // });
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/addusers', [UserController::class, 'create'])->name('users.add');
        Route::post('/addusers', [UserController::class, 'store'])->name('users.add');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('products/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        
        
        //sales route
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/addSales', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/addSales', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/salesDate', [SaleController::class, 'viewDate'])->name('sales.viewDate');
    Route::post('/salesDate', [SaleController::class, 'dateFilter'])->name('sales.dateFilter');
});

require __DIR__ . '/auth.php';
