<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $user = Auth::user();

    return view('dashboard', [ 
        'total' => $user->tasks()->count(),
        'todo' => $user->tasks()->status('todo')->count(),
        'doing' => $user->tasks()->status('doing')->count(),
        'done' => $user->tasks()->status('done')->count(),
    ]);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/create', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show')->middleware('task.middleware');
    Route::get('/tasks/{id}/edit', [TaskController::class, 'form_update'])->name('tasks.edit')->middleware('task.middleware');
    Route::put('/tasks/{id}', [TaskController::class, 'do_update'])->name('tasks.update')->middleware('task.middleware');
    Route::delete('/tasks/{id}', [TaskController::class, 'delete'])->name('tasks.delete')->middleware('task.middleware');

});

require __DIR__.'/auth.php';


Route::get('/profile/2fa', function () {
    return view('profile.two-factor');
})->middleware(['auth', 'verified'])->name('profile.2fa');
