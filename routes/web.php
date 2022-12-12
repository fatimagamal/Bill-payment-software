<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\SectionsController;
use App\Http\Controllers\ProductsController;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\InvoicesAttachementController;
use App\Http\Controllers\InvoicesArchiveController;
use App\Http\Controllers\InvoiceReportController;
use App\Http\Controllers\CustomerReportController;
use App\Models\invoices_details;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

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

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';

Auth::routes();


Route::get('invoices', [InvoicesController::class, 'index']);
Route::get('invoices/create', [InvoicesController::class, 'create']);
Route::post('invoices', [InvoicesController::class, 'store']);

Route::get('printInvoices/{id}', [InvoicesController::class, 'print']);


Route::get('invoicesPaid', [InvoicesController::class, 'getinvoicesPaid']);
Route::get('invoicesUnpaid', [InvoicesController::class, 'getinvoicesUnpaid']);
Route::get('invoicesPartialPaid', [InvoicesController::class, 'getinvoicesPartialPaid']);

Route::delete('invoices', [InvoicesController::class, 'destroy']);

Route::get('invoicesPayment/{id}', [InvoicesController::class, 'invoicesPayment']);
Route::post('changeInvoicesPayment', [InvoicesController::class, 'changeInvoicesPaymentStatus']);


////////////////////////////////////////////////////////////////////
Route::get('mark_as_read_all', [InvoicesController::class, 'mark_as_read_all']);

//////////////////////////////////////////////////////////////////////////////////


Route::get('showInvoicesArchive', [InvoicesArchiveController::class, 'index']);
Route::post('invoicesArchive', [InvoicesArchiveController::class, 'update']);
Route::delete('invoicesArchive', [InvoicesArchiveController::class, 'destroy']);





///////////////////////////////////////////////////////////////////////////
Route::get('invoicesDetails/{id}', [InvoicesDetailsController::class, 'index']);

/////////////////////////////////////////////////////////////////////////////
Route::delete('invoicesAttachement', [InvoicesAttachementController::class, 'destroy']);
Route::get('showFile/{invoice_number}/{fileName}', [InvoicesAttachementController::class, 'showFile']);
Route::get('downloadFile/{invoice_number}/{fileName}', [InvoicesAttachementController::class, 'download_file']);
Route::post('storeAtachements', [InvoicesAttachementController::class, 'storeAtachements']);

///////////////////////////////////////////////////////////////////////////////////////
Route::get('sections', [SectionsController::class, 'index']);

Route::get('getSectionById/{id}', [SectionsController::class, 'getSectionById']);//////////////

Route::post('sections', [SectionsController::class, 'store']);
Route::delete('sections', [SectionsController::class, 'destroy']);
Route::put('sections', [SectionsController::class, 'update']);


// Route::get('sections', [SectionsController::class, 'show']);

//->name('hh');

////////////////////////////////////////////////////////////////////////////////////////////
Route::GET('products', [ProductsController::class, 'index']);
Route::post('products', [ProductsController::class, 'store']);
Route::put('products', [ProductsController::class, 'update']);
Route::delete('products', [ProductsController::class, 'destroy']);


//////////////////////////////////////////////////////////////////////////////////////////
Route::get('invoicesReport', [InvoiceReportController::class, 'index']);
Route::post('invoicesReport', [InvoiceReportController::class, 'search']);



Route::get('customerReport', [CustomerReportController::class, 'index']);
Route::post('customerReport', [CustomerReportController::class, 'search']);



/////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/index', [AdminController::class, 'index']);
Route::get('home', [HomeController::class, 'index']);

////////////////////////////////////////////////////////////////////////permission
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});