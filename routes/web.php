<?php

use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StepController;

Route::redirect('/', '/ideas');

Route::middleware('auth')->group(function() {
    Route::get('/ideas', [IdeaController::class, 'index'])->name('idea.index');
    Route::post('/idea/store', [IdeaController::class, 'store'])->name('idea.store');
    Route::get('/idea/{idea}', [IdeaController::class, 'show'])->name('idea.show');
    Route::delete('/idea/{idea}', [IdeaController::class, 'destroy'])->name('idea.delete');

    Route::delete('/idea/{idea}/image', [IdeaController::class, 'destroyImage'])->name('idea.destroyImage');

    Route::patch('/step/{step}', [StepController::class, 'update'])->name('step.update');

    Route::delete('logout', [SessionsController::class, 'destroy']);
});


Route::middleware('guest')->group(function() {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/login', [SessionsController::class, 'store']);
});