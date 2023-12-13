<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tasks = $user
            ->tasks()
            ->where('completed', false)
            ->orderByDesc('created_at')
            ->get();

        $completedTasks = $user
            ->tasks()
            ->where('completed', true)
            ->orderByDesc('created_at')
            ->get();

        // $tasksGroup = $tasks->mapToGroups(function($task, $key){
        //     $cat = $task->completed ? 'done' : 'todo';
        //     return [$cat => $task];
        // });

        return view('dashboard', [
            'user' => $user,
            'tasks' => $tasks,
            'completedTasks' => $completedTasks
        ]);
    }

    public function add(Request $request)
    {
        $task = Task::make();
        $task->description = $request->input('description');
        $task->user_id = auth()->user()->id;
        $task->save();

        return redirect()->route('dashboard');
    }

    public function update(Request $request, Task $task)
    {
        if ($request->input('completed') === null) {
            $completedValue = false;
        } else {
            $completedValue = true;
        }
        $task->completed = $completedValue;
        $task->save();

        return redirect()->back();
    }

    public function delete(Task $task)
    {
        $task->delete();

        return redirect()->back();
    }
}