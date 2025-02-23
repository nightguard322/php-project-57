<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status->name,
            'name' => [
                'value' => $this->name,
                'link' => null
            ],
            'createdBy' => $this->createdBy->name,
            'assignedTo' => $this->assignedTo->name,
            'createdAt' => $this->created_at->format('d-m-Y'),
        ];
    }
}
