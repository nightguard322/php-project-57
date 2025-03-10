<?php

namespace App\Http\ViewModels;

use App\Http\Helpers\BaseHelper;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Task;

class TaskViewModel
{
    protected ?Task $model;
    public readonly array $asignees;
    public readonly ?int $selectedAsignee;
    public readonly array $statuses;
    public readonly ?int $selectedStatus;
    protected string $className = 'tasks';
    protected $links;

    /**
     * @param Task $model
     */
    public static function prepareModel(Task $model, ?Collection $asignees = null, ?Collection $statuses = null): self
    {
        $instanse = new self($model);
        $instanse->model = $model;
        $instanse->asignees = $asignees->toArray();
        $instanse->selectedAsignee = array_search($model->assignee->name, $asignees->toArray());
        $instanse->statuses = $statuses->toArray();
        $$instanse->selectedStatus = array_search($model->status->name, $statuses->toArray());
        return $instanse;
    }

    public function present()
    {
        return 
        [
            'id' => $this->model->id,
            'status' => $this->model->status->name,
            'link' => $this->model->name,
            'createdBy' => $this->model->createdBy->name,
            'assignedTo' => $this->model->assignedTo->name ?? null,
            'createdAt' => $this->model->created_at->format('d-m-Y')
        ];
    }

    /**
     * @Prepare headers for view with translations
     *
     * @param [array] $headers
     * @return self
     */

    public function prepareLinks(string|array $actions): self
    {
        $this->links = BaseHelper::getDynamicRoutes($this->model, $actions);
        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setLinks(array $links): void
    {
        $this->links = $links;
    }
}