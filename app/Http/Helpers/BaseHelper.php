<?php

namespace App\Http\Helpers;

use Illuminate\Database\Eloquent\Collection;

class BaseHelper
{
        /**
     * @prepare parent models to view with an array
     *
     * @param array $parents
     * @return array
     */
    public static function prepareParentData(array $parents): array
    {
        return collect($parents)
            ->mapWithKeys(
                fn($parent) => [
                    strtolower($parent) => ['all' => static::getParentData($parent)]
                ])
            ->toArray();
    }

    /**
     * @get current data to view in form
     */

    protected static function getParentData(string $parent)
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
    public static function getLinks($data, $actions)
    {
            if ($data instanceof Collection) {
                return $data->mapWithKeys(function ($element) use ($actions) {
                    return [$element->id => static::getDefaultRoutes($element, $actions)];
                })->toArray();
            }
            return static::getDefaultRoutes($data, $actions);
    }
    
    /**
     * Prepare default routes with entity id
     *
     * @param mixed $entity
     * @return void
     */
    protected static function getDefaultRoutes(mixed $entity, mixed $actions)
    {
        $staticActions = ['create', 'store'];
        $prefix = strtolower(class_basename($entity)) . 's';
        $routes = array_map(fn ($action) => 
                in_array($action, $staticActions)
                ? route("{$prefix}.{$action}")
                : route("{$prefix}.{$action}", $entity->id)
            , array($actions));
        return array_combine($actions, $routes);
    }
}