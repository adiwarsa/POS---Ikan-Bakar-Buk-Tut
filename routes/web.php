<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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


Route::controller(DashboardController::class)->middleware(['auth', 'only_admin'])->group(function () {
	Route::get('/', 'index')->name('home');
});

Route::controller(UserController::class)->middleware(['auth', 'only_admin'])->name('users.')->group(function () {
	Route::get('/users', 'index')->name('index');
	Route::post('/users', 'store')->name('store');
	Route::get('/users/create', 'create')->name('create');
	Route::get('/users/{user}/edit', 'edit')->name('edit');
	Route::put('/users/{user}/update', 'update')->name('update');
	Route::delete('/users/{user}/delete', 'delete')->name('delete');
});

Route::controller(StockController::class)->name('stock.')->group(function () {
	Route::get('/stock', 'index')->name('index');
	Route::post('/stock', 'store')->name('store');
	Route::get('/stock/create', 'create')->name('create');
	Route::get('/stock/{id}/edit', 'edit')->name('edit');
	Route::put('/stock/{id}/update', 'update')->name('update');
	Route::delete('/stock/{id}/delete', 'delete')->name('delete');
});

Route::controller(SupplierController::class)->name('supplier.')->group(function () {
	Route::get('/supplier', 'index')->name('index');
	Route::post('/supplier', 'store')->name('store');
	Route::get('/supplier/create', 'create')->name('create');
	Route::get('/supplier/{id}/edit', 'edit')->name('edit');
	Route::put('/supplier/{id}/update', 'update')->name('update');
	Route::delete('/supplier/{id}/delete', 'delete')->name('delete');
});

Route::controller(StockInController::class)->name('stockin.')->group(function () {
	Route::get('/stockin', 'index')->name('index');
	Route::post('/stockin', 'store')->name('store');
	Route::get('/stockin/create', 'create')->name('create');
	Route::get('/stockin/{id}/edit', 'edit')->name('edit');
	Route::put('/stockin/{id}/update', 'update')->name('update');
	Route::delete('/stockin/{id}/delete', 'delete')->name('delete');
});
Route::controller(StockOutController::class)->name('stockout.')->group(function () {
	Route::get('/stockout', 'index')->name('index');
	Route::post('/stockout', 'store')->name('store');
	Route::get('/stockout/create', 'create')->name('create');
	Route::get('/stockout/{id}/edit', 'edit')->name('edit');
	Route::put('/stockout/{id}/update', 'update')->name('update');
	Route::delete('/stockout/{id}/delete', 'delete')->name('delete');
});

Route::controller(FoodController::class)->name('food.')->group(function () {
	Route::get('/food', 'index')->name('index');
	Route::post('/food', 'store')->name('store');
	Route::get('/food/create', 'create')->name('create');
	Route::get('/food/createdrink', 'createdrink')->name('createdrink');
	Route::get('/food/{id}/edit', 'edit')->name('edit');
	Route::put('/food/{id}/update', 'update')->name('update');
	Route::delete('/food/{id}/delete', 'delete')->name('delete');
});

Route::controller(PaketController::class)->name('paket.')->group(function () {
	Route::get('/paket', 'index')->name('index');
	Route::post('/paket', 'store')->name('store');
	Route::get('/paket/create', 'create')->name('create');
	Route::get('/paket/{id}/edit', 'edit')->name('edit');
	Route::put('/paket/{id}/update', 'update')->name('update');
	Route::delete('/paket/{id}/delete', 'delete')->name('delete');
});

Route::controller(TransactionController::class)->name('transaction.')->group(function () {
	Route::get('/transaction', 'index')->name('index');
	Route::post('/transaction', 'store')->name('store');
	Route::get('/transaction/create', 'create')->name('create');
	Route::get('/transaction/{id}/edit', 'edit')->name('edit');
	Route::put('/transaction/{id}/update', 'update')->name('update');
	Route::delete('/transaction/{id}/delete', 'delete')->name('delete');
	Route::get('/transaction/{id}/print', 'print')->name('print');

});

require 'auth.php';
