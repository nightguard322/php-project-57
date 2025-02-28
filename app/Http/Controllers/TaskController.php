<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Helpers\BaseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Presenters\TaskPresenter;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $task = Task::with('status', 'createdBy', 'assignedTo')->get();
        $tasks = new TaskPresenter($task);
        return view('tasks.index', [
            'entities' => $tasks->presentCollection($tasks),
            'links' => BaseHelper::getLinks($task, ['edit', 'show'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $task = new Task();
        return view('tasks.create', [
            'task' => $task,
            'relatedModels' => BaseHelper::prepareParentData(['User', 'TaskStatus']),
            'links' => BaseHelper::getLinks($task, ['store'])
        ]);
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
        $preparedTask = $task->present($task);
        return view('tasks.edit', [
            'task' => $preparedTask,
            'related' => BaseHelper::prepareParentData(
                $preparedTask,
                ['assignedTo' => 'User', 'status' => 'TaskStatus']
            ),
            'links' => BaseHelper::getLinks($task, ['edit'])
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
        $task->fill($validated);
        $task->save();
        // dd($validated, $task);
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
