<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;


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
    return view('welcome');
});

Route::group(['prefix' => 'dashboard',],function(){
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    
    Route::group(['prefix' => 'users',], function () {
    //Route::get('/', 'UserController@index')->name('user.index');
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/create',[UserController::class, 'create'])->name('user.create');
    Route::post('/store',[UserController::class, 'store'])->name('user.store');

    Route::group(['prefix' => '{user}'], function () {
    Route::get('/show',[UserController::class, 'show'])->name('user.show');
    // Route::get('/edit','UserController@edit')->name('user.edit');
    // Route::patch('/','Usercontroller@update')->name('user.update');
    // Route::get('/delete','UserController@delete')->name('user.delete');
    // Route::delete('/','UserController@destroy')->name('user.destroy');

    });
});






});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
