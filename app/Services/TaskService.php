<?php

namespace App\Http\Services;

use Illuminate\Support\Str;
use App\Models\Task;

class TaskService
{
    
    
    public function present($id)
    {
        $task = Task::with('assignedTo:id,name', 'status:id,name')->find($id);
        return 
        [
            'id' => $task->id,
            'status' => $task->status->name,
            'name' =>  $task->name,
            'createdBy' => $task->createdBy->name,
            'assignedTo' => $task->assignedTo->name,
            'createdAt' => $task->created_at->format('d-m-Y')
        ];
    }

    public function presentCollection()
    {
        $task = Task::with('assignedTo:id,name', 'status:id,name')->all();
        return array_merge(
            ['data' => parent::prepareCollection(
                $this->data,
                fn($element) => $this->present($element)
                )
            ],
            $this->prepareMeta([
                'id',
                'status',
                'name',
                'createdBy',
                'assignee',
                'created_at']
            )
        );
    }

    public function prepareMeta(array $headers): array
    {
        return array_merge_recursive(
            parent::prepareMeta($headers),
            ['meta' => ['withLink' => 'name']
        ]);
    }
    public function prepareMeta(array $headers): array
    {
        $className = strtolower($this->getClassName());
        return [
            'meta' => [
                'headers' => $this->prepareHeaders($headers, $className),
                'createRoute' => route("{$className}s.create")
            ]
        ];
    }
    /**
     * @Prepare headers for view with translations
     *
     * @param [array] $headers
     * @return array
     */
    protected function prepareHeaders($headers, $className): array
    {
        return collect($headers)
            ->mapWithKeys(
                fn($header) => [$header => __("{$className}s.{$header}")]
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
}