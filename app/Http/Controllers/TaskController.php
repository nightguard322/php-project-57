<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\dataFetcherTrait;
use App\Models\Task;
use App\Http\ViewModels\TaskViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\ViewModels\TaskCollectionViewModel;

class TaskController extends Controller
{
    use dataFetcherTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::with('status', 'createdBy', 'assignee')->get();
        $preparedTask = TaskCollectionViewModel::prepareCollection($tasks);
        $preparedTask->prepareHeaders()->prepareLinks(['create', 'show', 'edit']);
        return view('tasks.index', compact('preparedTask'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $assignees= $this->fetchUsersFields();
        $statuses = $this->fetchStatusesFields();
        $preparedTask = TaskViewModel::prepareModel(new Task(), $assignees, $statuses);
        return view('tasks.create', compact('preparedTask'));
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
        $preparedTask = TaskViewModel::prepareModel(new Task());
        $preparedTask->prepareLinks('edit');
        return view('tasks.show', compact('preparedTask'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $assignees= $this->fetchUsersFields();
        $statuses = $this->fetchStatusesFields();
        $preparedTask = TaskViewModel::prepareModel($task, $assignees, $statuses);
        return view('tasks.create', compact('preparedTask'));
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
