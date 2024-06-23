<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\SubCriteriaController;
use App\Http\Controllers\HistoryUserController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\RecomendationController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'permission']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/cars', [CarsController::class, 'index'])->name('index');    
    Route::group(['prefix'=> 'users', 'as' => 'users.'], function(){
        Route::resource('permissions', PermissionsController::class);
        Route::resource('roles', RolesController::class);
    });    
    Route::resource('users', UsersController::class); 
    Route::resource('cars', CarsController::class); 
    // Route::resource('alternative', AlternativeController::class); 
    Route::resource('criteria', CriteriaController::class); 
    Route::resource('subcriteria', SubCriteriaController::class); 
    Route::resource('evaluation', EvaluationController::class); 
    Route::resource('recomendation', RecomendationController::class); 
    Route::resource('history', HistoryUserController::class); 
    
    Route::get('test3', function(){
        return "Route for superuser without assigning";
    })->name('test3');
});