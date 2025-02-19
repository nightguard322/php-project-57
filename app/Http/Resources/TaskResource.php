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
            'Статус' => $this->status->name,
            'Имя' => $this->name,
            'Автор' => $this->createdBy->name,
            'Исполнитель' => $this->assignedTo->name,
            'Дата создания' => $this->created_at
        ];
    }
}
