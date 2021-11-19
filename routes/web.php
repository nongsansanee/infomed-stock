<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockItemController;
use App\Http\Controllers\ReportStockController;
use App\Http\Controllers\CreateOrderController;
use App\Http\Controllers\AdminReportStockController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CheckInOrderController;
use App\Http\Controllers\ItemTransactionController;
use App\Http\Controllers\PrintFormController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/menu', function () {
 return view('testmenuweb');
//  return Redirect::route('/login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

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

Route::get('/stock-item/{stock_item}', [ItemTransactionController::class,'show'])->name('list-stock-item');
//เบิกพัสดุ
Route::post('/checkout-stock-item', [ItemTransactionController::class,'store'])->name('checkout-stock-item');

Route::get('/create-report-stock/{division_id}', [ReportStockController::class,'index'])->name('create-report-stock');

Route::get('/report-stock/{division_id}', [ReportStockController::class,'show'])->name('report-stock');
//Route::get('/report-stock/show/{division_id}', [ReportStockController::class,'index'])->name('report-stock-show');

//หน้าแรกสร้างใบสั่งซื้อ
Route::get('/create-order/{division_id}', [CreateOrderController::class,'index'])->name('create-order');
//สร้างใบสั่งซื้อ
Route::post('/create-order/add', [CreateOrderController::class,'store'])->name('add-order');
//พิมพ์ใบสั่งซื้อ
Route::get('/create-order/print/{order}', [PrintFormController::class,'show'])->name('print-order');
//แสดงรายการสร้างเอกสารใบสั่งซื้อ
Route::get('/order-list/{division_id}', [CreateOrderController::class,'show'])->name('order-list');
//ส่งเอกสารใบสั่งซื้อ
Route::post('/order-list/update', [CreateOrderController::class,'update'])->name('send-order');
//บันทึกรับพัสดุใหม่ลงคลัง
Route::post('/order-list/checkin/', [CheckInOrderController::class,'store'])->name('checkin-order');


Route::get('/admin/report-list/{division_id}', [AdminReportStockController::class,'index'])->name('report-list');
Route::get('/admin/report-stock/{stock_slug}/{year}/{month}', [AdminReportStockController::class,'show'])->name('admin-report-stock');

//แสดงรายการใบสั่งซื้อ
Route::get('/admin/order-list/', [AdminOrderController::class,'index'])->name('check-order-list');
//อนุมัติใบสั่งซื้อ
Route::post('/admin/order-list/update', [AdminOrderController::class,'update'])->name('approve-order');

//printForm
Route::get('/testprint', [PrintFormController::class,'index'])->name('testprint');