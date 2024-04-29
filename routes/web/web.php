<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class , 'index'])->name('home');


Auth::routes(['verify' => true]);
Route::get('/profile' , [App\Http\Controllers\User\Profile\ProfileController::class , 'index'])->name('profile');
Route::get('/getCities/{countryId}', [App\Http\Controllers\User\PropertyController::class , 'getCities']);
Route::get('/property-info/{property}' , [App\Http\Controllers\HomeController::class , 'showProperty'])->name('showProperty'); 

Route::resource('users' , App\Http\Controllers\User\UserController::class );
Route::resource('properties' , App\Http\Controllers\User\PropertyController::class );

