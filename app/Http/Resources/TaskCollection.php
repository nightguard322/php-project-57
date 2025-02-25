<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Model;

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
            'data' => TaskResource::collection($this->collection),
            'meta' => [
                'headers' => [
                    'id' => __('tasks.id'),
                    'status' => __('tasks.status'),
                    'name' => __('tasks.name'),
                    'createdBy' => __('tasks.createdBy'),
                    'assignee' => __('tasks.assignee'),
                    'created_at' => __('tasks.created_at')
                ],
                'withLink' => 'name',
                'createRoute' => route('tasks.create')
            ]
        ];
    }

    public function getLinks()
    {
        return $this->collection->map(function ($element){
            return [
                $element->id => $this->getDefaultRoutes($element)
            ];
        });
    }

    public function getDefaultRoutes(mixed $entity)
    {
        $actions = ['edit', 'update', 'destroy', 'show'];
        $routes =  array_map(
            fn ($action) => route("tasks.{$action}", $entity->id), $actions
        );
        return array_combine($actions, $routes);
    }
}
