<?php

namespace App\Presenters;

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

}