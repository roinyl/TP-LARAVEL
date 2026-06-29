<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Affiche la liste des tâches de l'utilisateur connecté
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $tasks = $user->tasks()->get();

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
        /** @var User $user */
        $user = Auth::user();

        // Grâce à la relation hasMany, Laravel remplit automatiquement user_id
        $user->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'todo',
        ]);

        return redirect('/tasks')->with('success', 'Votre tâche a été créée avec succès.');
    }

    // Affiche le formulaire de modification d'une tâche
    public function form_update(int $id)
    {
        /** @var User $user */
        $user = Auth::user();

        // Recherche uniquement dans les tâches de l'utilisateur connecté
        $task = $user->tasks()->findOrFail($id);

        return view('tasks.edit', compact('task'));
    }

    // Met à jour une tâche existante
    public function do_update(UpdateTaskRequest $request, int $id)
    {
        /** @var User $user */
        $user = Auth::user();

        // Empêche de modifier une tâche appartenant à un autre utilisateur
        $task = $user->tasks()->findOrFail($id);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect('/tasks')->with('sucess', 'votre tache a été modifier avec success');
    }

    // Affiche le détail d'une tâche
    public function show(int $id)
    {
        /** @var User $user */
        $user = Auth::user();

        // Recherche uniquement dans les tâches de l'utilisateur connecté
        $task = $user->tasks()->findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    // Supprime une tâche
    public function delete(int $id)
    {
        /** @var User $user */
        $user = Auth::user();

        // Empêche de supprimer une tâche appartenant à un autre utilisateur
        $task = $user->tasks()->findOrFail($id);

        $task->delete();

        return redirect('/tasks')->with('sucess', 'votre tache a été supprimer avec succes');
    }
}