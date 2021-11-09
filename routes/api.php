<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TechnologyController;
use Illuminate\Support\Facades\Route;


// creation des routes pour les projets:
Route::get('/projects',[ProjectController::class,'index']);
Route::post('/projects/create',[ProjectController::class,'store']);
Route::get('/projects/{id}',[ProjectController::class,'show'])->whereNumber('id');
Route::patch('/technologies/{id}',[ProjectController::class,'update'])->whereNumber('id');
Route::delete('/projects{id}',[ProjectController::class,'destroy'])->whereNumber('id');


// creation des routes pour les technologies:

Route::get('/technologies',[TechnologyController::class,'index']);
Route::post('/technologies/create',[TechnologyController::class,'store']);
Route::get('/technologies/{id}',[TechnologyController::class,'show'])->whereNumber('id');
Route::patch('/technologies/update/{id}',[TechnologyController::class,'update'])->whereNumber('id');
Route::delete('/technologies/delete/{id}',[TechnologyController::class,'destroy'])->whereNumber('id');