<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentInfoController;
use App\Http\Controllers\StudentResultController;
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


 Route::group(['namespace' => "App\Http\Controllers\StudentInfoController"], function(){
    Route::get('index', [StudentInfoController::class, 'index']);
    Route::post('stud/store', [StudentInfoController::class, 'store'])->name('add-studentInfo');
    Route::post('stud/update', [StudentInfoController::class, 'update'])->name('edit-studentInfo');
    Route::post('stud/delete/{stud_id}', [StudentInfoController::class, 'destroy'])->name('delete-studentInfo');
});

Route::group(['namespace' => "App\Http\Controllers\StudentResultController"], function(){
    Route::get('studResult/{stud_id}', [StudentResultController::class, 'index'])->name('studResult');
    Route::post('studResult/store', [StudentResultController::class, 'store'])->name('add-studentResult');
    Route::post('studResult/update', [StudentResultController::class, 'update'])->name('edit-studentResult');
    Route::post('studResult/delete/{result_id}', [StudentResultController::class, 'destroy'])->name('delete-studentResult');
});
