<?php

use Illuminate\Support\Facades\Auth;
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
Route::group(['middleware' => 'admin_panel'], function () {
    Route::get('/', \App\Http\Controllers\IndexController::class)->name('index');
});
Route::get('/mylogin', \App\Http\Controllers\LoginController::class)->name('mylogin');

//Route::get('/key/{key}', \App\Http\Controllers\KeyController::class)->name('key');

Route::get('/key/{key}', function ($key) {
    if($user = \App\Models\User::where('key', $key)->first()){
        Auth::login($user, $remember = true);
        return redirect()->route('index');
    }
   return redirect()->route('mylogin');
});

Auth::routes();

Route::group(['prefix' => 'products', 'middleware' => 'add_product'], function () {
    Route::get('/create', \App\Http\Controllers\Product\CreateController::class)->name('product.create');
    Route::post('/', \App\Http\Controllers\Product\Main\StoreController::class)->name('product.store');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin_panel'], function () {

    Route::get('/', \App\Http\Controllers\Admin\IndexController::class)->name('admin.index');

    Route::group(['prefix' => 'users'], function () {
        Route::get('/export', [\App\Http\Controllers\Admin\Excel\TablesController::class, 'export'])->name('export');//EXCEL
        Route::get('/', \App\Http\Controllers\Admin\Users\IndexController::class)->name('admin.user.index');
        Route::get('/create', \App\Http\Controllers\Admin\Users\CreateController::class)->name('admin.user.create');
        Route::post('/', \App\Http\Controllers\Admin\Users\StoreController::class)->name('admin.user.store');
        Route::get('/{user}', \App\Http\Controllers\Admin\Users\ShowController::class)->name('admin.user.show');
        Route::get('/{user}/edit', \App\Http\Controllers\Admin\Users\EditController::class)->name('admin.user.edit');
        Route::patch('/{user}', \App\Http\Controllers\Admin\Users\UpdateController::class)->name('admin.user.update');
        Route::delete('/{user}', \App\Http\Controllers\Admin\Users\DeleteController::class)->name('admin.user.delete');
    });
    Route::group(['prefix' => 'tables'], function () {
        Route::post('/export', [\App\Http\Controllers\Admin\Excel\TablesController::class, 'export'])->name('admin.excel');//EXCEL
        Route::get('/', \App\Http\Controllers\Admin\Tables\IndexController::class)->name('admin.table.index');
        Route::post('/', \App\Http\Controllers\Admin\Tables\PostController::class)->name('admin.table.post');
    });
    Route::group(['prefix' => 'products'], function () {
        Route::get('/all', \App\Http\Controllers\Product\IndexController::class)->name('admin.product.index');
        Route::post('/all', \App\Http\Controllers\Product\ProductController::class)->name('admin.allproduct.index');
        Route::get('/create', \App\Http\Controllers\Product\CreateController::class)->name('admin.product.create');
        Route::post('/', \App\Http\Controllers\Product\StoreController::class)->name('admin.product.store');
        Route::get('/{product}', \App\Http\Controllers\Product\ShowController::class)->name('admin.product.show');
        Route::get('/{product}/edit', \App\Http\Controllers\Product\EditController::class)->name('admin.product.edit');
        Route::patch('/{product}', \App\Http\Controllers\Product\UpdateController::class)->name('admin.product.update');
        Route::delete('/{product}', \App\Http\Controllers\Product\DeleteController::class)->name('admin.product.delete');
    });
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("/offline", function () {

    return view("vendor.laravelpwa.offline");

});
Route::get("/notactive", function () {

    return view("not_active");

})->name('notactive');
