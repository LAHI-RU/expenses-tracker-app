<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/entries/create', [EntryController::class, 'create'])->name('entries.create');
Route::post('/entries', [EntryController::class, 'store'])->name('entries.store');
Route::get('/entries', [EntryController::class, 'index'])->name('entries.index');
Route::redirect('/', '/dashboard');
});
