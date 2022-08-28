<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home');

Route::inertia('/lessons', 'Lessons');

Route::middleware('guest')->group(function(){
    Route::get('auth', [\App\Http\Controllers\AuthController::class, 'index'])->name('auth.index');
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
});

Route::middleware('auth')->group(function(){
    Route::post('logout', [\App\Http\Controllers\AuthController::class, ('logout')])->name('auth.logout');

    Route::post('subjects/import', [\App\Http\Controllers\SubjectController::class, 'import']);
    Route::get('template-lessons/export', [\App\Http\Controllers\TemplateLessonController::class, 'export']);

    Route::resource('admin-lessons', \App\Http\Controllers\LessonController::class);
    Route::resource('template-lessons', \App\Http\Controllers\TemplateLessonController::class);
    Route::resource('subjects', \App\Http\Controllers\SubjectController::class);
});
