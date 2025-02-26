<?php

namespace App\Presenters;
use App\Models\TaskStatus;
use App\Models\User;

class TaskPresenter extends BasePresenter
{
    

    public function present()
    {
        return 
        [
            'id' => $this->model->id,
            'status' => $this->model->status->name,
            'name' =>  $this->model->name,
            'createdBy' => $this->model->createdBy->name,
            'assignedTo' => $this->model->assignedTo->name,
            'createdAt' => $this->model->created_at->format('d-m-Y'),
        ];
    }

    public function presentCollection()
    {
        return array_merge(
            ['data' => parent::prepareCollection(
                fn($element) => [
                        'id' => $element->id,
                        'status' => $element->status->name,
                        'name' =>  $element->name,
                        'createdBy' => $element->createdBy->name,
                        'assignedTo' => $element->assignedTo->name,
                        'createdAt' => $element->created_at->format('d-m-Y'),
                    ]
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
     * @param [type] $presented
     * @param array $parents
     * @param string $field
     * @return void
     */
    public function prepareParentData(array $presented, array $parents, array $fields): array
    {
        return collect($parents)
            ->mapWithKeys(
                fn($parent, $alias) => [
                    $parent => [
                        'all' => $this->getParentData($parent, $fields),
                        'current' => array_search($presented[$alias], $parents)
                    ]
                ],
                $parents)
            ->toArray();
    }

    protected function getParentData(string $parent, array $fields)
    {
        $namespace = 'App\Models\\';
        return "{$namespace}{$parent}"::all()
            ->pluck(implode(',', $fields))
            ->toArray();
    }

}