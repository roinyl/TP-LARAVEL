<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Affiche la liste des tâches de l'utilisateur connecté
    public function index()
    {
        $tasks = Auth::user()->tasks()->get();

        return view('tasks.index', compact('tasks'));
    }

    // Affiche le formulaire de création d'une tâche
    public function create()
    {
        return view('tasks.create');
    }

    // Enregistre une nouvelle tâche
    public function store(TaskRequest $request)
    {
        Auth::user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'todo',
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Votre tâche a été créée avec succès.');
    }

    // Affiche le formulaire de modification d'une tâche
    public function form_update(int $id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);

        return view('tasks.edit', compact('task'));
    }

    // Met à jour une tâche
    public function do_update(UpdateTaskRequest $request, int $id)
    {
        $task = Auth::user()->tasks()->findOrFail($id); // si existe pas retourne 404

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Votre tâche a été modifiée avec succès.');
    }

    // Affiche le détail d'une tâche
    public function show(int $id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    // Supprime une tâche
    public function delete(int $id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Votre tâche a été supprimée avec succès.');
    }
}