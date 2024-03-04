<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/profile' , [App\Http\Controllers\Admin\Profile\ProfileController::class , 'index'])->name('profile');