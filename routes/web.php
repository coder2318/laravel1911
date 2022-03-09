<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
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

// Route::get('/welcome/{name}', function($name) {
//     return view('test', ['name' => $name]);
// });

Route::get('/test1', [TestController::class, 'index']);
Route::get('/user-create', [TestController::class, 'create']);

Route::group(['middleware' => ['auth', 'ip']], function () {
    Route::get('/category', [ProductController::class, 'category'])->name('category.index');
    // Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    // Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    // Route::post('/products/store', [ProductController::class, 'store'])->name('product.store');
    // Route::get('/products/show/{product}', [ProductController::class, 'show'])->name('product.show');
    // Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    // Route::put('products/update/{product}', [ProductController::class, 'update'])->name('product.update');
    // Route::delete('products/delete/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::resource('products', ProductController::class);
});


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
