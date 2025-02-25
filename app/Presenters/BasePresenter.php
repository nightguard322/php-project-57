<?php

namespace App\Presenters;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;


abstract class BasePresenter
{

    protected $model;
    protected $collection;
    protected $className;
    protected $actions = ['edit', 'update', 'destroy', 'show'];

    public function __construct(mixed $entity)
    {
        if ($entity instanceof Collection) {
            $this->collection = $entity;
        } else {
            $this->model = $entity;
        }
        
        $this->className = strtolower($this->getClassName());
    }

    abstract public function present();

    /**
     * @get meta information with headers
     *
     * @param [type] $headers
     * @return array
     */

    public function prepareMeta(array $headers): array
    {
        return [
            'meta' => [
                'headers' => $this->prepareHeaders($headers),
                'createRoute' => route("{$this->className}s.create")
            ]
        ];
    }
    /**
     * @Prepare headers for view with translations
     *
     * @param [array] $headers
     * @return array
     */
    protected function prepareHeaders($headers): array
    {
        return collect($headers)
            ->mapWithKeys(
                fn($header) => [$header => __("{$this->className}s.{$header}")]
            )
            ->toArray();
    }

    /**
     * @get Classname without namespace
     *
     * @return string
     */
    protected function getClassName(): string
    {
        return Str::replace(
            'Presenter',
            '',
            class_basename(static::class)
        );
    }
    /**
     * @prepare links for each route with default route list
     * 
     * @return array
     */

    public function getLinks(): array
    {
        if ($this->collection) {
            return $this->collection->mapWithKeys(function ($element) {
                return [$element->id => $this->getDefaultRoutes($element)];
            })->toArray();
        }
        return $this->getDefaultRoutes($this->model);
    }

    /**
     * Undocumented function
     *
     * @param mixed $entity
     * @return void
     */
    protected function getDefaultRoutes(mixed $entity)
    {
        $routes =  array_map(
            fn ($action) => route("tasks.{$action}", $entity->id), $this->actions
        );
        return array_combine($this->actions, $routes);
    }

    protected function prepareCollection(callable $fn)
    {
        return $this->collection->map($fn)->toArray();
    }
}