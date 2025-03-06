<?php

namespace App\Http\ViewModels;

use App\Http\Helpers\BaseHelper;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Task;

class TaskViewModel
{
    protected ?Collection $collection;
    protected ?Task $model;
    protected array $headers = [
        'id',
        'status',
        'name',
        'createdBy',
        'assignee',
        'created_at'
];
    protected $preparedHeaders;
    public readonly array $asignees;
    public readonly ?int $selectedAsignee;
    public readonly array $statuses;
    public readonly ?int $selectedStatus;
    protected string $className = 'tasks';
    protected $links;

    public static function prepareCollection(Collection $collection)
    {
        $instanse = new self($collection);
        $instanse->collection = $collection;
        return $instanse;
    }

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

    public function presentCollection()
    {
        return collect($this->collection)
            ->map(fn($element) => $this->present($element));
    }

    /**
     * @Prepare headers for view with translations
     *
     * @param [array] $headers
     * @return self
     */
    public function prepareHeaders(?array $headers = null): self
    {
        $className = BaseHelper::getClassName($this);
        $this->preparedHeaders = collect($headers ?? $this->headers)
            ->mapWithKeys(
                fn($header) => [$header => __("{$className}.{$header}")]
            )
            ->toArray();
        return $this;
    }

    public function prepareLinks(string|array $actions): self
    {
        $this->links = BaseHelper::getLinks($this->model, $actions);
        return $this;
    }

    public function getFormData(array $parents): Collection
    {
        return collect($parents)
            ->mapWithKeys(fn($parent, $name) => [
                $name => [
                    'values' => $parent,
                    'current' => array_search($this->collection->$name, $parent->toArray())
                ]
            ]);
    }
}