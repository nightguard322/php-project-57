<?php

namespace App\Http\ViewModels;

use App\Http\Helpers\BaseHelper;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Task;

class TaskViewModel
{
    protected ?Collection $tasks;
    protected ?Task $task;
    protected array $headers = [
        'id',
        'status',
        'name',
        'createdBy',
        'assignee',
        'created_at'
];
    public readonly array $asignees;
    public readonly ?int $selectedAsignee;
    public readonly array $statuses;
    public readonly ?int $selectedStatus;
    protected string $className = 'tasks';

    public static function withCollection(Collection $tasks)
    {
        $instanse = new self($tasks);
        $instanse->tasks = $tasks;
        return $instanse;
    }

    public static function withModel(Task $task, Collection $asignees, Collection $statuses): self
    {
        $instanse = new self($task);
        $instanse->task = $task;
        $instanse->asignees = $asignees->toArray();
        $instanse->selectedAsignee = array_search($task->assignee->name, $asignees->toArray());
        $instanse->statuses = $statuses->toArray();
        $$instanse->selectedStatus = array_search($task->status->name, $statuses->toArray());
        return $instanse;
    }

    public function present()
    {
        return 
        [
            'id' => $this->task->id,
            'status' => $this->task->status->name,
            'link' => $this->task->name,
            'createdBy' => $this->task->createdBy->name,
            'assignedTo' => $this->task->assignedTo->name ?? null,
            'createdAt' => $this->task->created_at->format('d-m-Y')
        ];
    }

    public function presentCollection()
    {
        return collect($this->tasks)
            ->map(fn($element) => $this->present($element));
    }

    /**
     * @Prepare headers for view with translations
     *
     * @param [array] $headers
     * @return array
     */
    public function prepareHeaders(): array
    {
        return collect($this->headers)
            ->mapWithKeys(
                fn($header) => [$header => __("{$this->className}.{$header}")]
            )
            ->toArray();
    }

    /**
     * @get Classname without namespace
     *
     * @return string
     */
    protected function getClassName(): string
    {
        return Str::replace(
            'Service',
            '',
            class_basename(static::class)
        );
    }

    public function prepareLinks($actions)
    {
        return BaseHelper::getLinks($this->tasks, $actions);
    }

    public function getFormData(array $parents)
    {
        return collect($parents)
            ->mapWithKeys(fn($parent, $name) => [
                $name => [
                    'values' => $parent,
                    'current' => array_search($this->tasks->$name, $parent->toArray())
                ]
            ]);
    }
}