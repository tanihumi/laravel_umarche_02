<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ComponentTestController;
use App\Http\Controllers\LifeCycleTestController;
use App\Http\Controllers\User\ItemController;
use App\Http\Controllers\User\CartController;


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

Route::get('/', function () {
    return view('user.welcome');
});


Route::middleware('auth:users')->group(function () {
    Route::get('/', [ItemController::class, 'index'])->name('items.index');
    Route::get('show/{item}', [ItemController::class, 'show'])->name('items.show');
});


Route::prefix('cart')->middleware('auth:users')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('add', [CartController::class, 'add'])->name('cart.add');
});




Route::get('/component-test1', [ComponentTestController::class, 'showComponent1']);
Route::get('/component-test2', [ComponentTestController::class, 'showComponent2']);

Route::get('/servicecontainer', [LifeCycleTestController::class, 'showServiceContainerTest']);
Route::get('/serviceprovider', [LifeCycleTestController::class, 'showServiceProviderTest']);

Route::middleware('auth:users')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
