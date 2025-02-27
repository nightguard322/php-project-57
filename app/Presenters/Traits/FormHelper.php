<?php

use Illuminate\Database\Eloquent\Collection;

Trait FormHelper
{
        /**
     * @prepare parent models to view with an array
     *
     * @param array $parents
     * @return array
     */
    public function prepareParentData(array $parents): array
    {
        return collect($parents)
            ->mapWithKeys(
                fn($parent) => [
                    strtolower($parent) => ['all' => $this->getParentData($parent)]
                ],
                $parents)
            ->toArray();
    }

    /**
     * @get current data to view in form
     */


    protected function getParentData(string $parent)
    {
        $namespace = 'App\Models\\';
        return "{$namespace}{$parent}"::all()
            ->pluck('name', 'id')
            ->toArray();
    }
    /**
     * @prepare links for each route with default route list
     * 
     * @return array
     */
    public function getLinks()
    {
        $data = $this->data;
            if ($data instanceof Collection) {
                return $data->mapWithKeys(function ($element) {
                    return [$element->id => $this->getDefaultRoutes($element)];
                })->toArray();
            }
            return $this->getDefaultRoutes($data);
    }
    
    /**
     * Prepare default routes with entity id
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
}