<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\SubCriteriaController;
use App\Http\Controllers\HistoryUserController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\RecomendationController;
use App\Http\Controllers\listCarController;
use App\Http\Controllers\FinalController;
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
    return view('auth/login');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'permission']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/getDataChart', [DashboardController::class, 'getDataChart'])->name('dashboard.getDataChart');
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::resource('permissions', PermissionsController::class);
        Route::resource('roles', RolesController::class);
    });
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('update', [ProfileController::class, 'update'])->name('profile.update');
    });
    Route::resource('users', UsersController::class);
    Route::resource('cars', CarsController::class);
    Route::resource('list-cars', listCarController::class);
    Route::resource('criteria', CriteriaController::class);
    Route::resource('subcriteria', SubCriteriaController::class);
    Route::resource('evaluation', EvaluationController::class);
    Route::resource('recomendation', RecomendationController::class);
    Route::post('recomendation/calculate', [RecomendationController::class, 'calculate'])->name('recomendation.calculate');
    Route::get('hasil-akhir', [FinalController::class, 'index'])->name('hasil-akhir.index');
    Route::get('hasil-akhir/download', [FinalController::class, 'download'])->name('hasil-akhir.download');
    Route::get('history', [HistoryUserController::class, 'index'])->name('history.index');
    Route::get('history/download', [HistoryUserController::class, 'download'])->name('history.download');
});
