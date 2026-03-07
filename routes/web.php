<?php

use App\Http\Controllers\Admin\Ad\CreateController;
use App\Http\Controllers\Admin\Ad\DestroyController;
use App\Http\Controllers\Admin\Ad\EditController;
use App\Http\Controllers\Admin\Ad\ShowController;
use App\Http\Controllers\Admin\Ad\StoreController;
use App\Http\Controllers\Admin\Ad\UpdateController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\Ad\IndexController;


Route::get('/', [HomeController::class, 'index']);

//Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function()
//{
//    Route::group(['namespace' => 'Ad'], function()
//    {
//        Route::get('/admin/ad', 'IndexController')->name('admin.ad.index');
//
//    });
//});
Route::prefix('admin')->group(function () {
    Route::get('/ads', IndexController::class)->name('admin.ad.index');
    Route::get('/ads/create', CreateController::class)->name('admin.ad.create');
    Route::post('/ads', StoreController::class)->name('admin.ad.store');
    Route::get('/ads/{ad}/edit', EditController::class)->name('admin.ad.edit');
    Route::patch('/ads/{ad}', UpdateController::class)->name('admin.ad.update');
    Route::get('/ads/{ad}', ShowController::class)->name('admin.ad.show');
    Route::delete('ads/{ad}', DestroyController::class)->name('admin.ad.delete');



});

Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/ads', [AdController::class, 'index'])->name('ad.index');
Route::get('/ads/create', [AdController::class, 'create'])->name('ad.create');
Route::post('/ads', [AdController::class, 'store'])->name('ad.store');
Route::get('/ads/{ad}', [AdController::class, 'show'])->name('ad.show');
Route::get('/ads/{ad}/edit', [AdController::class, 'edit'])->name('ad.edit');
Route::patch('/ads/{ad}', [AdController::class, 'update'])->name('ad.update');
Route::delete('ads/{ad}', [AdController::class, 'destroy'])->name('ad.delete');

Route::get('/ads/update', [AdController::class, 'update']);
Route::get('/ads/delete', [AdController::class, 'delete']);
Route::get('/ads/first_or_create', [AdController::class, 'firstOrCreate']);
Route::get('/ads/update_or_create', [AdController::class, 'updateOrCreate']);

Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/main', [MainController::class, 'index'])->name('main.index');




// Route::get('/users', function () {
//     //return 'ttt'/*view('welcome')*/;
//     $user = User::find(1);
//     return dd($user);
// });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
