<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use App\Models\Task;

class CheckTaskOwner
{
    public function handle(Request $request, $next)
    {
        $task = Task::findOrFail($request->route('id'));

        if ($task->user_id !== auth()->id()) {
            abort(403, "Vous n'avez pas accès a cette tache : la tache ne vous appartient pas !");
        }

        return $next($request);
    }
}