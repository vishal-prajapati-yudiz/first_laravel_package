<?php

use Illuminate\Support\Facades\Route;
use Spatie\Skeleton\Http\Controllers\ContactusController;

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

//Routes
Route::get('/contactus',[ContactusController::class, 'index'])->name('contactus');
Route::post('/contactus/email', [ContactusController::class,'checkEmail'])->name('user.contactus.email');
Route::post('/contactus/contact', [ContactusController::class,'checkContact'])->name('user.contactus.contact');
Route::post('/contactus/store', [ContactusController::class, 'store'])->name('contactus.save');
  