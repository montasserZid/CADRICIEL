<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
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
    return view('home');
});
Route::get('/home',[BlogController::class,'index']);
Route::get('/about',[BlogController::class,'about']);
Route::get('/contact',[BlogController::class,'contact']);
Route::post('/contact',[BlogController::class,'contactForm']);
Route::get('/Portfolio',[BlogController::class,'Portfolio']);
Route::get('/services',[BlogController::class,'services']);


