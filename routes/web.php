<?php

use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TodoListController::class, 'render'])->name('todo.index');
Route::post('/', [TodoListController::class, 'store'])->name('todo.store');
Route::delete('/{id}', [TodoListController::class, 'destroy'])->name('todo.destroy');
Route::patch('/{id}', [TodoListController::class, 'mark'])->name('todo.mark');