<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\TaskResource;
use App\Presenters\TaskPresenter;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Task::with('status', 'createdBy', 'assignedTo')->get();
        $tasks = new TaskPresenter($data);
        return view('tasks.index', [
            'entities' => $tasks->presentCollection($tasks),
            'links' => $tasks->getLinks()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $taskData = 
            [
                'task' => new Task(),
                'statuses' => TaskStatus::all(),
                'users' => User::all()
            ];
        return view('tasks.create', compact('taskData', 'statuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'description' => 'nullable|max:255',
                'status_id' => 'required|exists:task_statuses,id',
                'assigned_to_id' => 'nullable|exists:user,id'
            ]
        );
        $validated['created_by_id'] = Auth::id();
        $task = Task::create($validated);
        return redirect()->route('tasks.show', $task->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $task = new TaskPresenter($task);
        return view('tasks.edit', [
            'task' => $task->present($task),
            'links' => $task->getLinks(),
            'users' => User::all()->pluck('name')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'max:255',
            'status_id' => 'required',
            'assigned_to_id' => 'nullable'
            ]);
        $task->update($validated);
        return redirect()->route('tasks.show', $task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
