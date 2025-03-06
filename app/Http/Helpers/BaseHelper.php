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
    public static function getDynamicRoutes(Model $entity, mixed $actions): array
{
    $prepared = is_array($actions) ? $actions : [$actions];
    $prefix = self::getPrefix($entity);

    return collect($prepared)
        ->mapWithKeys(function ($action) use ($prefix, $entity) {
            if (!in_array($action, self::$dynamicRoutes)) {
                throw new \InvalidArgumentException("Wrong route name - $action");
            }
            if (!$entity->exists) {
                throw new \LogicException("Dynamic route {$action} requires persistent model");
            }
            return [$action => route("{$prefix}.{$action}", $entity->id)];
        })
        ->toArray();
}

    public static function getStaticRoutes($entity)
    {
        $prefix = self::getPrefix($entity);
        return collect(self::$commonRoutes)
            ->mapWithKeys(function ($action) use ($prefix) {
                if (in_array($action, self::$commonRoutes)) {
                    return [$action => route("{$prefix}.{$action}")];
                }
                throw new \InvalidArgumentException("Wrong route name - $action");
            })
            ->toArray();
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