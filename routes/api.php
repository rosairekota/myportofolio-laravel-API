<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TechnologyController;




// creation des routes pour les abouts:
Route::apiResource('abouts', AboutController::class);

// creation des routes pour les projets:
Route::apiResource('projects', ProjectController::class);

// creation des routes pour les categories
Route::apiResource('categories', CategoryController::class);

// creation des routes pour les technologies:
Route::apiResource('technologies', TechnologyController::class);


// creation des routes pour les services:
Route::apiResource('services', ServiceController::class);

// creation des routes pour les skills:
Route::apiResource('skills', SkillController::class);


