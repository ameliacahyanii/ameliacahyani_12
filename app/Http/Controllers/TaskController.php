<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        // $this->middleware('verified');
        $this->middleware('is_admin');
    }

    public function index (Request $request) 
    {
        // get all data
        // untuk menampilkan data dari suatu model/ resource

        if ($request->search) {
            $task = Task::where('task', 'LIKE', "%$request->search%")
            ->paginate(5);

            return view('task.index', [
                'data' => $task
            ]);
        }

        $task = Task::paginate(5);
        return view('task.index', [
            'data' => $task
        ]);
    }
    
    public function create ()
    {
        return view('task.create');
    }

    public function edit ($id) 
    {
        $task = Task::find($id);
        return view('task.edit', compact('task'));
    }

    public function store (TaskRequest $request) 
    {
        Task::create ([
            'task' => $request->task,
            'user' => $request->user,
        ]);

        return redirect('/tasks');
    }

    public function show ($id) 
    {
        $task = Task::find($id);
        return $task;
    }

    public function update (TaskRequest $request, $id) 
    {
        $task = Task::find($id);

        $task->update([
            'task' => $request->task,
            'user' => $request->user
        ]);

        return redirect('/tasks');
    }

    public function destroy ($id) 
    {
        $task = Task::find($id);
        $task->delete();

        return redirect('/tasks');
    }

    
}
