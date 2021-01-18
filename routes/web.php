<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\ServantsController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PayementController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ReportController;


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

Route::get('/login', function () {
  return view('login');
})->name('login')->middleware(['guest']);

Route::post('/login', [UserController::class, 'authenticate']);
Route::get('/logout', [UserController::class, 'logout'])->middleware(['auth']);

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth']);

// Categories Routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/create/category', [CategoryController::class, 'create'])->name('categories.create');
Route::get('/edit/category/{category}', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/update/category/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/delete/category/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Tables Routes
Route::get('/tables', [TablesController::class, 'index'])->name('tables.index');
Route::post('/create/table', [TablesController::class, 'create'])->name('tables.create');
Route::get('/edit/table/{table}', [TablesController::class, 'edit'])->name('tables.edit');
Route::put('/update/table/{table}', [TablesController::class, 'update'])->name('tables.update');
Route::delete('/delete/table/{table}', [TablesController::class, 'destroy'])->name('tables.destroy');

// Servants Routes
Route::get('/servants', [ServantsController::class, 'index'])->name('servants.index');
Route::post('/create/servant', [ServantsController::class, 'create'])->name('servants.create');
Route::get('/edit/servant/{servant}', [ServantsController::class, 'edit'])->name('servants.edit');
Route::put('/update/servant/{servant}', [ServantsController::class, 'update'])->name('servants.update');
Route::delete('/delete/servant/{servant}', [ServantsController::class, 'destroy'])->name('servants.destroy');

// Menus Routes
Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
Route::post('/create/menu', [MenuController::class, 'create'])->name('menus.create');
Route::get('/edit/menu/{menu}', [MenuController::class, 'edit'])->name('menus.edit');
Route::put('/update/menu/{menu}', [MenuController::class, 'update'])->name('menus.update');
Route::delete('/delete/menu/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');

// Payement Route
Route::get('/payements', [PayementController::class, 'index'])->name('payements.index');

// Sales Routes
Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
Route::post('/create/sale', [SalesController::class, 'create'])->name('sales.create');
Route::get('/edit/sale/{sale}', [SalesController::class, 'edit'])->name('sales.edit');
Route::put('/update/sale/{sale}', [SalesController::class, 'update'])->name('sales.update');
Route::delete('/delete/sale/{sale}', [SalesController::class, 'destroy'])->name('sales.destroy');

//Reports Route
Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
Route::post('reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
Route::post('reports/export', [ReportController::class, 'export'])->name('reports.export');
