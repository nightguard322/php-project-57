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
            'id' => $this->data->id,
            'status' => $this->data->status->name,
            'name' =>  $this->data->name,
            'createdBy' => $this->data->createdBy->name,
            'assignedTo' => $this->data->assignedTo->name,
            'createdAt' => $this->data->created_at->format('d-m-Y')
        ];
    }

    public function presentCollection()
    {
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


}