<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'home']);

Route::get('/template', function () {
    return view('template');
});

// user controller
Route::get('/login', [UserController::class, 'login'])->middleware('onlyGuest');
Route::post('/login', [UserController::class, 'doLogin'])->middleware('onlyGuest');

Route::get('/logout', [UserController::class, 'doLogout'])->middleware('onlyMember');
Route::post('/logout', [UserController::class, 'doLogout'])->middleware('onlyMember');

// todo controller
Route::get('/todoList', [TodoController::class, 'display'])->middleware('onlyMember');
Route::post('/todoList_create', [TodoController::class, 'create'])->middleware('onlyMember');
Route::post('/todoList_delete', [TodoController::class, 'delete'])->middleware('onlyMember');