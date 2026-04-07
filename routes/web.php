<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/customers', [CustomersController::class, 'index']);
Route::get('/customers/trash/{id}', [CustomersController::class, 'trash'])->name('customers.trash');
Route::get('/customers/trashed', [CustomersController::class, 'trashed'])->name('customers.trashed');
Route::get('/customers/delete/{id}', [CustomersController::class, 'delete'])->name('customers.delete');
Route::get('/customers/restore/{id}', [CustomersController::class, 'restore'])->name('customers.restore');