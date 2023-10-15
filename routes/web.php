<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;
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

Route::get('/', [TransactionController::class, 'index'])->middleware('auth');


//login view
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);


//input form view
Route::get('/input-form', function () {
    return view('inputform.inform', [
        'active' => 'input-form',
        'listBaju' => []
    ]);
})->middleware('auth');
Route::get('/input-form/{id}', [TransactionController::class, 'getTransaction'])->middleware('auth');
Route::post('/transactions', [TransactionController::class, 'createPO']);
Route::post('/transactions/update', [TransactionController::class, 'updateTransaction']);
Route::post('/end-transactions', [TransactionController::class, 'selesaiPekerjaan']);
Route::post('/delete-transactions', [TransactionController::class, 'deletePekerjaan']);

//pending form view
Route::get('/pending-form', [TransactionController::class, 'viewPending'])->middleware('auth');

//role view
Route::get('/user', [UserController::class, 'index'])->middleware('auth');
Route::post('/user', [UserController::class, 'store'])->middleware('auth');
Route::get('/user/{id}', [UserController::class, 'getUser'])->middleware('auth');
Route::post('/delete-user', [UserController::class, 'deleteUser'])->middleware('auth');

//history view
Route::get('/history', [TransactionController::class, 'viewHistory'])->middleware('auth')->middleware('role:Admin|Supervisor');

//Form PO view
Route::get('/formpo/{id}', [TransactionController::class, 'generateFormPO'])->middleware('auth');

//Form Desain view
Route::get('/worksheet/{id}', [TransactionController::class, 'generateFormWorksheet'])->middleware('auth');

//Form Invoice view
Route::get('/forminvoice/{id}', [TransactionController::class, 'generateFormInvoice'])->middleware('auth');
