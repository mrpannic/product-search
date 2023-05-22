<?php

Route::get('/', [ AuthController::class, 'showLogin' ]);

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/edit', [UserController::class, 'edit']);
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users/store', [UserController::class, 'store']);
Route::put('/users/update', [UserController::class, 'update']);
Route::delete('/users/delete', [UserController::class, 'delete']);

Route::get('/items', [ItemController::class, 'showItemSearch']);
Route::get('/items/search', [ItemController::class, 'search']);
Route::get('/items/show', [ItemController::class, 'showItem']);