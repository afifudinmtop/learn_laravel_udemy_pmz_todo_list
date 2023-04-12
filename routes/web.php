<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// })->middleware('onlyMember');

Route::get('/', [HomeController::class, 'home']);

Route::get('/template', function () {
    return view('template');
});

// user controller
Route::get('/login', [UserController::class, 'login'])->middleware('onlyGuest');
Route::post('/login', [UserController::class, 'doLogin']);

Route::get('/logout', [UserController::class, 'doLogout'])->middleware('onlyMember');
Route::post('/logout', [UserController::class, 'doLogout']);