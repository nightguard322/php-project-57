<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/tasks', [TaskController::class, 'index'])
    ->name('tasks.index');
Route::get('/tasks/create', [TaskController::class, 'show'])
    ->name('tasks.show');
Route::get('/tasks/create', [TaskController::class, 'create'])
    ->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])
    ->name('tasks.store');
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])
    ->name('tasks.edit');
Route::patch('/tasks/{task}', [TaskController::class, 'update'])
    ->name('tasks.update');
Route::delete('/task/{task}', [TaskController::class, 'destroy'])
    ->name('tasks.destroy');


























