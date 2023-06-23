<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestController;

Route::prefix('todos')->group(function() {
    Route::post('', [RestController::class, 'saveTodo']);
    Route::put('/{todo_id}', [RestController::class, 'updateTodo']);
    Route::get('', [RestController::class, 'getTodoList']);
    Route::get('/count', [RestController::class, 'getTodoListCount']);
    Route::delete('', [RestController::class, 'deleteTodos']);
});
