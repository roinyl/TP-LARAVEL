<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->get();

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function post(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = 'todo';
        $task->user_id = auth()->id();
        $task->save();

        return redirect('/tasks');
    }

    public function form_update($id)
    {
        $task = Task::findOrFail($id);

        abort_if($task->user_id !== auth()->id(), 403);

        return view('tasks.edit', compact('task'));
    }

    public function do_update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        abort_if($task->user_id !== auth()->id(), 403);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,doing,done',
        ]);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->save();

        return redirect('/tasks');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);

        abort_if($task->user_id !== auth()->id(), 403);

        return view('tasks.show', ['task' => $task]);
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);

        abort_if($task->user_id !== auth()->id(), 403);

        $task->delete();

        return redirect('/tasks');
    }
}
