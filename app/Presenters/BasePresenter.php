<?php

namespace App\Presenters;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;


abstract class BasePresenter
{
    protected $actions = ['edit', 'update', 'destroy', 'show'];

    abstract public function present($model);

    /**
     * @get meta information with headers
     *
     * @param [type] $headers
     * @return array
     */

    public function prepareMeta(array $headers): array
    {
        $className = strtolower($this->getClassName());
        return [
            'meta' => [
                'headers' => $this->prepareHeaders($headers, $className),
                'createRoute' => route("{$className}s.create")
            ]
        ];
    }
    /**
     * @Prepare headers for view with translations
     *
     * @param [array] $headers
     * @return array
     */
    protected function prepareHeaders($headers, $className): array
    {
        return collect($headers)
            ->mapWithKeys(
                fn($header) => [$header => __("{$className}s.{$header}")]
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

    public function getLinks($data): array
    {
        if ($data instanceof Collection) {
            return $data->mapWithKeys(function ($element) {
                return [$element->id => $this->getDefaultRoutes($element)];
            })->toArray();
        }
        return $this->getDefaultRoutes($data);
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

    protected function prepareCollection($collection, callable $fn)
    {
        return $collection->map($fn)->toArray();
    }
}