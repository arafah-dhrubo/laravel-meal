<?php

use App\Http\Controllers\MealController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MealController::class, 'index']);
Route::get('/add-meal', [MealController::class, 'create']);
Route::post('/save-meal', [MealController::class, 'store']);
Route::get('/edit-meal/{id}', [MealController::class, 'edit']);
Route::post('/update-meal/{id}', [MealController::class, 'update']);
Route::get('/delete-meal/{id}', [MealController::class, 'destroy']);
