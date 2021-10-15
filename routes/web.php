<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockItemController;
use App\Http\Controllers\ReportStockController;
use App\Http\Controllers\CreateOrderController;
use App\Http\Controllers\AdminReportStockController;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/login-as/{division_id}', [StockController::class,'index']);

Route::post('/login', function () {
    return "wait";
  //  return Redirect::route('/login');
});

Route::get('/logout', function () {
    Auth::logout();
    return "wait";
  //  return Redirect::route('/login');
});

Route::get('/', function () {
    return Inertia::render('Stock/index');
})->name('index')->middleware('auth');

Route::get('/calendar', function () {
    return Inertia::render('Calendar');
})->name('calendar');

// Route::get('/stock', function () {
//     return Inertia::render('Stock/index');
// })->name('stock');

Route::get('/stock/{division_id}', [StockController::class,'index'])->name('stock');

// Route::get('/stock-item/{id}', function () {
//     return Inertia::render('Stock/ItemDetail');
// })->name('stock-item');

Route::get('/stock-item/{item_id}', [StockItemController::class,'index'])->name('stock-item');

Route::get('/report-stock/{division_id}', [ReportStockController::class,'index'])->name('report-stock');
//Route::get('/report-stock/show/{division_id}', [ReportStockController::class,'index'])->name('report-stock-show');

Route::get('/create-order/{division_id}', [CreateOrderController::class,'index'])->name('create-order');

Route::get('/order-list/{division_id}', [CreateOrderController::class,'show'])->name('order-list');

Route::get('/admin/report-list/', [AdminReportStockController::class,'index'])->name('report-list');

