<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TechnologyController;
use Illuminate\Support\Facades\Route;


// creation des routes pour les projets:
Route::apiResource('project',ProjectController::class);

// creation des routes pour les technologies:

Route::apiResource('technology',TechnologyController::class);