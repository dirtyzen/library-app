<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeProcessController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/{categorySlug}/{productSlug}/{productId}', [ProductController::class, 'show'])->name('productDetail');

Route::group(['middleware' => 'auth'], function () {
    Route::post('/process/lease/request', [LeaseController::class, 'lease'])->name('leaseRequest');
    Route::post('/process/lease/cancel', [LeaseController::class, 'cancel'])->name('leaseCancel');
});

Route::group(['middleware' => 'employee', 'prefix' => 'employee'], function () {
    Route::get('/approval-requests', [EmployeeController::class, 'approvalRequests'])->name('employeeApprovalRequests');
    Route::get('/leased-list', [EmployeeController::class, 'leasedList'])->name('employeeLeasedList');
    Route::get('/returned-list', [EmployeeController::class, 'returnedList'])->name('employeeReturnedList');
    Route::post('/process/lease/approve', [EmployeProcessController::class, 'leaseApprove'])->name('employeeLeaseApprove');
    Route::post('/process/lease/cancel', [EmployeProcessController::class, 'leaseCancel'])->name('employeeLeaseCancel');
});

