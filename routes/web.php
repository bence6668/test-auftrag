<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceItemController;
use App\Http\Controllers\TempItemController;
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

Route::get('/', [InvoiceController::class, 'index']);

Route::resource('invoices', InvoiceController::class)->except(['index', 'show']);

Route::post('invoices/temp-item/create', [TempItemController::class, 'createTempItem'])->name('invoices.temp-item.create');
Route::delete('invoices/temp-item/{invoiceItem}/delete', [TempItemController::class, 'deleteTempItem'])->name('invoices.temp-item.delete');

Route::post('invoices/{invoice}/items', [InvoiceItemController::class, 'store'])->name('invoice-item.store');
Route::delete('invoice-items/{invoiceItem}', [InvoiceItemController::class, 'destroy'])->name('invoice-items.delete');

