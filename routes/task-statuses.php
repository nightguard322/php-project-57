<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskStatusController;

Route::get('/task-statuses', [TaskStatusController::class, 'index'])
    ->name('task-statuses.index');
Route::get('/task-statuses/create', [TaskStatusController::class, 'create'])
    ->name('task-statuses.create')->middleware('checkAuth');
Route::post('/task-statuses', [TaskStatusController::class, 'store'])
    ->name('task-statuses.store');
Route::get('/task-statuses/{id}/edit', [TaskStatusController::class, 'edit'])
    ->name('task-statuses.edit');
Route::patch('/task-statuses/{taskStatus}', [TaskStatusController::class, 'update'])
    ->name('task-statuses.update');
Route::delete('/task-statuses/{id}', [TaskStatusController::class, 'destroy'])
    ->name('task-statuses.destroy');