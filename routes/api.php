<?php

use App\Http\Controllers\Api\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('home',[StudentController::class,'index'])->name('home.show');
Route::post('home',[StudentController::class,'store'])->name('home.store');
Route::get('home/{id}',[StudentController::class,'getSingle'])->name('home.single');
Route::get('home/{id}/edit',[StudentController::class,'edit'])->name('home.edit');
Route::put('home/{id}/edit',[StudentController::class,'update'])->name('home.update');
Route::delete('home/{id}/delete',[StudentController::class,'delete'])->name('home.delete');



