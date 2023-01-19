<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Read Create Delete Update (CRUD)

Route::get('/read', [StudentController::class, 'read']);
Route::post('/create', [StudentController::class, 'create']);
Route::post('/delete', [StudentController::class, 'delete']);
Route::post('/update', [StudentController::class, 'update']);
