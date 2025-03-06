<?php

namespace App\Http\ViewModels;

use App\Http\Helpers\BaseHelper;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Task;
use App\Http\ViewModels\TaskViewModel;

class TaskCollectionViewModel
{
    protected ?Collection $collection;
    protected array $headers = [
        'id',
        'status',
        'name',
        'createdBy',
        'assignee',
        'created_at'
];
    protected $preparedHeaders;
    protected string $className = 'tasks';
    protected $links;

    public static function prepareCollection(Collection $collection)
    {
        $instanse = new self($collection);
        $instanse->collection = $collection;
        return $instanse;
    }

    public function presentCollection()
    {
        return collect($this->collection)
            ->map(fn(Task $element) => TaskViewModel::prepareModel($element));
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
            collect($this->collection)
                ->each(function(Task $element) use ($actions) {
                    $viewModel = TaskViewModel::prepareModel($element);
                    $links = BaseHelper::getDynamicRoutes($viewModel->getModel(), $actions);
                    $viewModel->setLinks($links);
                });
        return $this;
    }

}