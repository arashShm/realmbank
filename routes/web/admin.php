<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/profile' , [App\Http\Controllers\Admin\Profile\ProfileController::class , 'index'])->name('profile');


Route::resource('users' , App\Http\Controllers\Admin\UserController::class);
Route::resource('properties' , App\Http\Controllers\Admin\PropertyController::class);
Route::resource('countries' , App\Http\Controllers\Admin\CountryController::class);
Route::resource('cities' , App\Http\Controllers\Admin\CityController::class);
Route::resource('facilities' , App\Http\Controllers\Admin\FacilityController::class);
Route::resource('properties' , App\Http\Controllers\Admin\PropertyController::class);

Route::get('/location' , [App\Http\Controllers\Admin\LocationController::class , 'index'])->name('location.index');
Route::get('/location/create' , [App\Http\Controllers\Admin\LocationController::class , 'create'])->name('location.create');
Route::get('/getCities/{countryId}', [App\Http\Controllers\Admin\PropertyController::class , 'getCities']);
