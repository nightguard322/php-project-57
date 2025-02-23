<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($task) {
                $resource = new TaskResource($task);
                $data = $resource->toArray(request());
                $data['name']['link'] = route('tasks.edit', $task->id);
                return $data;
            }),
            'meta' => [
                'headers' => [
                    'id' => __('tasks.id'),
                    'status' => __('tasks.status'),
                    'name' => __('tasks.name'),
                    'createdBy' => __('tasks.createdBy'),
                    'assignee' => __('tasks.assignee'),
                    'created_at' => __('tasks.created_at')
                ]
            ]
        ];
    }
}
