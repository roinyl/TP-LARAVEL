<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    $user = Auth::user();

    $tasks = Task::where('user_id', $user->id)->get();

    return view('dashboard', [
        'total' => $tasks->count(),
        'todo' => $tasks->where('status', 'todo')->count(),
        'doing' => $tasks->where('status', 'doing')->count(),
        'done' => $tasks->where('status', 'done')->count(),
    ]);

})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/create', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/{id}/edit', [TaskController::class, 'form_update'])->name('tasks.edit');
    Route::put('/tasks/{id}', [TaskController::class, 'do_update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'delete'])->name('tasks.delete');

});

require __DIR__.'/auth.php';
