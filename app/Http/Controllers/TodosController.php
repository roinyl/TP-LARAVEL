<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    public function index(){
        $todos = Todo::all();
        return view('todos.index', ['salut' => $todos, 'title' => 'salutsalut']);
    }

    public function create(){
        return view('todos.create');
    }

    public function post(){

        $todo = new Todo();
        $todo->title = request()->title;
        $todo->description = request()->description;
        $todo->owner = auth()->id();
        $todo->save();

        return redirect('/todos');
    }

    public function form_update($id){
        return view('todos.update');
    }

    public function do_update(Request $request){

        $todo = Todo::findOrFail($id);
        $todo->title = $request->title;
        $todo->description = request()->description;
        $todo->owner = auth()->id();
        $todo->save();

        return redirect('/todos');
    }


    public function show($monID){

        /*
        $todo = Todo::where('id', '=', $monID)->first();
        $todo = Todo::where('id', $monID)->first();

        $todo = Todo::find($monID);
        if(!$todo){
            return abort(404);
        } 
        */

        $todo = Todo::findOrFail($monID);
        return view('todos.show', ['todo' => $todo]);
    }

    public function delete($monID){

        $todo = Todo::findOrFail($monID);

        if ($todo->owner !== auth()->id()) {
            abort(403);
        }

        $todo->delete();

        return redirect('/todos');
    }
}
