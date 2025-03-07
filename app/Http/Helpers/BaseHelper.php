<?php

namespace App\Http\Helpers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaseHelper
{
    /**
     * @prepare links for each route with default route list
     * 
     * @return array
     */
    private static array $commonRoutes = ['index', 'create', 'store'];
    private static array $dynamicRoutes = ['show', 'edit', 'delete'];
    
    /**
     * Prepare default routes with entity id
     *
     * @param mixed $entity
     * @return array
     */

    public static function getStaticRoutes(Collection $collection, array $actions)
    {
        return collect($actions)
        ->mapWithKeys(fn($action) => [
            $action => route("{self::getPrefix($collection)}.{$action}")
        ])
        ->toArray(); 
    }

    public static function getDynamicRoutes(Model $entity, array $actions)
    {
        return collect($actions)
            ->mapWithKeys(fn($action) => 
                $entity->exists 
                ? [$action => route("{self::getPrefix($entity)}.{$action}", $entity->id)]
                : throw new \LogicException("Dynamic route {$action} requires persistent model")
            )
            ->toArray(); 
    }


    public static function checkRoute($actions)
    {
        $prepared = is_array($actions) ? $actions : [$actions];
        return [
            'static' => array_intersect($prepared, self::$commonRoutes),
            'dynamic' => array_intersect($prepared, static::$dynamicRoutes)
        ];
    }

    private static function getPrefix($entity)
    {
        return Str::plural(
            Str::snake(class_basename($entity))
        );
    }
    /**
     *  Запрос на построение ссылок
     * Если статика - идут в свойство статики
     * если динамика - в динамику модели или через map
     * 
     * 
     */

    public static function getClassName($class): string
    {
        $basename = class_basename($class::class);
        return Str::of($basename) 
            ->replace('Service', '')
            ->snake()
            ->lower();
    }

}