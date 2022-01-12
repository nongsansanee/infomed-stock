<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\StockController;
//use App\Http\Controllers\StockItemController;
use App\Http\Controllers\ReportStockController;
use App\Http\Controllers\CreateOrderController;
use App\Http\Controllers\AdminReportStockController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CheckInOrderController;
use App\Http\Controllers\ItemTransactionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PrintFormController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

//******* route laravel auth create


require __DIR__.'/auth.php';

//***********route me create

Route::get('/', function () {
 // return view('welcome');
 return Inertia('Auth/Login');
});


// Route::get('/menu', function () {
//   return view('testmenuweb');
//  //  return Redirect::route('/login');
//  });
 
//  Route::get('/dashboardtest', function () {
//      return Inertia::render('Dashboard');
//  })->name('dashboard');
 
 
//  Route::get('/login-as/{division_id}', [StockController::class,'index'])->middleware('auth');

 
//  Route::get('/calendar', function () {
//      return Inertia::render('Calendar');
//  })->name('calendar');
 
 Route::get('/annouce', [LoginController::class,'index'])->middleware('auth');
//แสดงหน้าเบิกพัสดุ
 Route::get('/stock/{division_id}', [StockController::class,'index'])->name('stock')->middleware('auth','can:view_item');
 //แสดงรายละเอียดการเบิก/ตรวจรับ พัสดุ
 Route::get('/stock-item/{stock_item}', [ItemTransactionController::class,'show'])->name('list-stock-item')->middleware('auth');
 //เบิกพัสดุ
 Route::post('/checkout-stock-item', [ItemTransactionController::class,'store'])->name('checkout-stock-item')->middleware('auth');
 

 //ไม่แน่ใจว่าจะใช้ หน้าแสดงข้อมูลปีเดือน ที่มีการเบิกพัสดุ
 //Route::get('/report-stock/{division_id}', [ReportStockController::class,'show'])->name('report-stock')->middleware('auth');
 //ไม่แน่ใจว่าจะใช้ หน้าแสดงรายละเอียดการเบิกพัสดุ
 Route::get('/report-checkout-item/{division_id}', [ReportStockController::class,'index'])->name('report-checkout-item')->middleware('auth');
 Route::get('/get-checkout-item/{stock_id}/{year}/{month}', [ReportStockController::class,'show'])->name('get-checkout-item')->middleware('auth');

 
 //หน้าแรกสร้างใบสั่งซื้อ
 Route::get('/create-order/{division_id}', [CreateOrderController::class,'index'])->name('create-order')->middleware('auth');
 //สร้างใบสั่งซื้อ
 Route::post('/create-order/add', [CreateOrderController::class,'store'])->name('add-order')->middleware('auth');
 //พิมพ์ใบสั่งซื้อ
 Route::get('/create-order/print/{order}', [PrintFormController::class,'show'])->name('print-order')->middleware('auth');
 //แสดงรายการสร้างเอกสารใบสั่งซื้อ
 Route::get('/order-list/{division_id}', [CreateOrderController::class,'show'])->name('order-list')->middleware('auth');
 //ส่งเอกสารใบสั่งซื้อ
 Route::post('/order-list/update', [CreateOrderController::class,'update'])->name('send-order')->middleware('auth');
 //บันทึกรับพัสดุใหม่ลงคลัง
 Route::post('/order-list/checkin/', [CheckInOrderController::class,'store'])->name('checkin-order')->middleware('auth');
//แสดงหน้าตรวจรับพัสดุ
  Route::get('/receive-order/{order}', [CheckInOrderController::class,'update'])->name('receive-order')->middleware('auth');
 //พิมพ์ใบตรวจรับ
 Route::get('/create-order/print-checkin/{order}', [PrintFormController::class,'create'])->name('print-checkin')->middleware('auth');
 //ดูจำนวนคงเหลือหลังตรวจรับ
 Route::get('/order-list/show/{order_id}', [CheckInOrderController::class,'show'])->name('view-checkin-order')->middleware('auth');
 
 Route::get('/admin/report-list/{division_id}', [AdminReportStockController::class,'index'])->name('report-list')->middleware('auth');
 Route::get('/admin/report-stock/{stock_slug}', [AdminReportStockController::class,'show'])->name('admin-report-stock')->middleware('auth');
 
 //แสดงรายการใบสั่งซื้อ
 Route::get('/admin/order-list/', [AdminOrderController::class,'index'])->name('check-order-list')->middleware('auth');
 //อนุมัติใบสั่งซื้อ
 Route::post('/admin/order-list/update', [AdminOrderController::class,'update'])->name('approve-order')->middleware('auth');
 
 //printForm
 Route::get('/testprint', [PrintFormController::class,'index'])->name('testprint');