<?php

namespace App\Presenters;
use App\Models\TaskStatus;
use App\Models\User;

class TaskPresenter extends BasePresenter
{
    
    public function present($model)
    {
        return 
        [
            'id' => $model->id,
            'status' => $model->status->name,
            'name' =>  $model->name,
            'createdBy' => $model->createdBy->name,
            'assignedTo' => $model->assignedTo->name,
            'createdAt' => $model->created_at->format('d-m-Y'),
        ];
    }

    public function presentCollection($collection)
    {
        return array_merge(
            ['data' => parent::prepareCollection(
                $collection,
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
    /**
     * @prepare parent models to view with an array
     *
     * @param array $parents
     * @return array
     */
    public function prepareParentData(array $parents): array
    {
        return collect($parents)
            ->mapWithKeys(
                fn($parent) => [
                    strtolower($parent) => ['all' => $this->getParentData($parent)]
                ],
                $parents)
            ->toArray();
    }

    /**
     * @get current data to view in form
     */


    protected function getParentData(string $parent)
    {
        $namespace = 'App\Models\\';
        return "{$namespace}{$parent}"::all()
            ->pluck('name', 'id')
            ->toArray();
    }

}