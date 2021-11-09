<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;


// creation des routes pour les projets:
Route::get('/projects',[ProjectController::class,'index']);
Route::post('/projects/create',[ProjectController::class,'store']);
Route::get('/projects/{id}',[ProjectController::class,'show'])->whereNumber('id');
Route::delete('/projects{id}',[ProjectController::class,'index'])->whereNumber('id');