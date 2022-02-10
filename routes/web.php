<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Users
Route::get('/user/delete/{user_id}', [HomeController::class, 'delete'])->name('user.delete');

//Category
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/insert', [CategoryController::class, 'insert'])->name('category.insert');
Route::get('/category/edit/{cat_id}', [CategoryController::class, 'edit'])->name('category.edit');
