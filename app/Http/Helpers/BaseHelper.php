<?php

namespace App\Http\Helpers;

use Illuminate\Database\Eloquent\Collection;

class BaseHelper
{
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
        $prepared = is_array($actions) ? $actions : [$actions];
        $prefix = strtolower(class_basename($entity)) . 's';
        $routes = array_map(fn ($action) => 
                in_array($action, $staticActions)
                ? route("{$prefix}.{$action}")
                : route("{$prefix}.{$action}", $entity->id)
            , $prepared);
        return array_combine($actions, $routes);
    }

}