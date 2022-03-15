<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryController;

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

Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/master', [FrontendController::class, 'master'])->name('frontend.master');


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Users
Route::get('/user/delete/{user_id}', [HomeController::class, 'delete'])->name('user.delete');

//Category
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/insert', [CategoryController::class, 'insert'])->name('category.insert');
Route::get('/category/edit{cat_id}', [CategoryController::class, 'edit'])->name('category_edit');
Route::post('/category/update', [CategoryController::class, 'update'])->name('category_update');
Route::get('/category/delete/{cat_id}', [CategoryController::class, 'delete'])->name('category_delete');
Route::get('/category/restore/{cat_id}', [CategoryController::class, 'restore'])->name('category_restore');
Route::get('/category/force_delete/{cat_id}', [CategoryController::class, 'force_delete'])->name('category_force_delete');

//SubCategory
Route::get('/subcategory', [SubcategoryController::class, 'index'])->name('subcategory.index');
Route::post('/subcategory/insert', [SubcategoryController::class, 'insert'])->name('subcategory.insert');

//dashbaord
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('index.dashboard');

//Profile 

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/name_change', [ProfileController::class, 'name_change'])->name('profile.name.change');
Route::post('/profile/pass_change', [ProfileController::class, 'pass_change'])->name('profile.pass.change');
Route::post('/profile/photo_change', [ProfileController::class, 'photo_change'])->name('profile.photo.change');

//Product
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::post('/getCategory', [ProductController::class, 'getCategory']);
Route::post('/product/insert', [ProductController::class, 'insert'])->name('product.insert');
//Inventory
Route::get('/inventory/{product_id}', [InventoryController::class, 'index'])->name('inventory.index');
Route::post('/inventory/color/insert', [InventoryController::class, 'color_insert']);
Route::get('/inventory/color', [InventoryController::class, 'color'])->name('inventory.color');
Route::get('/inventory/size', [InventoryController::class, 'size'])->name('inventory.size');
Route::post('/inventory/size/insert', [InventoryController::class, 'size_insert']);
Route::post('/inventory/insert', [InventoryController::class, 'inventory_insert'])->name('inventory.insert');

