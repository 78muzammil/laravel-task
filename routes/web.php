<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('list', [UserController::class, 'list'])->name('list');
Route::get('form/{id?}', [UserController::class, 'form'])->name('form');
Route::post('save', [UserController::class, 'save'])->name('save');
Route::delete('delete/{id}', [UserController::class, 'delete'])->name('delete');

Route::get('import/form', [UserController::class, 'importForm'])->name('import.form');
Route::post('import/file', [UserController::class, 'importFile'])->name('import.file');
