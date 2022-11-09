<?php

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

Route::get('/', function () {
  return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('mobil.index');
Route::get('add', [App\Http\Controllers\HomeController::class, 'create'])->name('mobil.create'); 
Route::post('store', [App\Http\Controllers\HomeController::class, 'store'])->name('mobil.store');

Route::get('edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('mobil.edit'); 
Route::post('update/{id}', [App\Http\Controllers\HomeController::class,  'update'])->name('mobil.update');
Route::post('delete/{id}', [App\Http\Controllers\HomeController::class,  'delete'])->name('mobil.delete');


