<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = new Task();
        return view('tasks.create', compact('task'));
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
                'created_by_id' => 'required|exists:users,id',
                'assigned_to_id' => 'nullable|exists:user,id'
            ]
        );
        $newTaskId = Task::create($validated)->id();
        return redirect()->route('task.show', $newTaskId);
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
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate(
            [
            'name' => 'required|string|max:255',
            'description' => 'max:255',
            'status_id' => 'required|exists:task_statuses,id',
            'created_by_id' => 'required|exists:users,id',
            'assigned_to_id' => 'nullable|exists:user,id'
            ]
        );
        $task->update($validated);
        return redirect()->route('task.show', $task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index');
    }
}
