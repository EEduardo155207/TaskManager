<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    
    public function index()
    {
        return response()->json(Task::where('user_id', Auth::id())->get());
    }

   
        //Criar tarefa.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'boolean'
        ]);

         $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return response()->json($task, 201);
    }

    //Visualizar tarefa especifica de usuáio.
    public function show(task $task)
    {
        $task = Task::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        return response()->json($task);
    }

    // atualizar tarefa  
    public function update(Request $request, task $task)
    {
        $task = Task::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'completed' => 'sometimes|boolean'
        ]);

        $task->update($request->only(['title', 'description', 'completed']));

        return response()->json($task);
    }

   //Apagar registro de tarefa.
    public function destroy(task $task)
    {
           $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $task->delete();
        return response()->json(['message' => 'Task deleted']);
    }
}
