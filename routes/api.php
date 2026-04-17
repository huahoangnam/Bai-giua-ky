<?php

use App\Http\Controllers\StudentApiController;
use Illuminate\Support\Facades\Route;

/**
 * Exercise 7: Student Management REST API
 * All routes return JSON responses following REST standards
 */

Route::prefix('api')->name('api.')->group(function () {
    Route::prefix('students')->name('students.')->group(function () {
        // Basic CRUD operations
        Route::get('/', [StudentApiController::class, 'index'])->name('index');
        Route::post('/', [StudentApiController::class, 'store'])->name('store');
        Route::get('/{id}', [StudentApiController::class, 'show'])->name('show');
        Route::put('/{id}', [StudentApiController::class, 'update'])->name('update');
        Route::delete('/{id}', [StudentApiController::class, 'destroy'])->name('destroy');

        // Subject registration endpoints
        Route::get('/{id}/subjects', [StudentApiController::class, 'getSubjects'])->name('get_subjects');
        Route::post('/{id}/register-subject/{subject_id}', [StudentApiController::class, 'registerSubject'])->name('register_subject');
        Route::delete('/{id}/unregister-subject/{subject_id}', [StudentApiController::class, 'unregisterSubject'])->name('unregister_subject');
    });
});
