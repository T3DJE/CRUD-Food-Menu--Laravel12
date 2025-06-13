<?php

use App\Http\Controllers\Role\AdminController;
use App\Http\Controllers\Role\OwnerController;
use App\Http\Controllers\Role\UserController;
use Illuminate\Support\Facades\Route;


//admin
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/create', [AdminController::class, 'index2']);
    Route::post('/process-create', [AdminController::class, 'createData']);
    Route::get('/delete/{id}', [AdminController::class, 'deleteData']);
    Route::get('/edit/{id}', [AdminController::class, 'index3']);
    Route::post('/process-edit', [AdminController::class, 'updateData']);
    Route::get('/adminhistory', [AdminController::class,'index4']);
});

//owner
Route::middleware(['auth', 'role:owner'])->group(function(){
    Route::get('/owner', [OwnerController::class, 'index']);
    Route::post('/createPembelian' ,[OwnerController::class, 'createPembelian']);
    Route::post('/createProduct' ,[OwnerController::class, 'createProduct']);
    Route::get('/history' ,[OwnerController::class, 'index2']);
    Route::get('/cashier' ,[OwnerController::class, 'index3']);
});

//user
Route::get('/', [UserController::class, 'index']);
Route::middleware(['auth', 'role:user'])->group(function(){
    Route::post('/search', [UserController::class, 'search']);
});

require __DIR__.'/auth.php';
