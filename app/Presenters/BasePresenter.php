<?php

namespace App\Presenter;

use Illuminate\Support\Str;

abstract class BasePresenter
{

    protected $model;
    protected $className;
    protected $actions = ['edit', 'update', 'destroy', 'show'];

    public function __construct($model)
    {
        $this->model = $model;
        $this->className = $this->getClassName();
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
                'createRoute' => route("{$this->className}.create")
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
        return $headers->
            collect()->
            mapWithKeys(
                fn($header) => [$header => __("{$this->className}.{$header}")]
            )->
            toArray();
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
            Str::basename(self::class)
        );
    }
    /**
     * @prepare links for each route with default route list
     * 
     * @return array
     */

    public function getLinks(): array
    {
        return $this->collection->map(function ($element) {
            return [
                $element->id => $this->getDefaultRoutes($element)
            ];
        });
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
        return $this->collection
            ->map($fn)
            ->toArray();
    }
}