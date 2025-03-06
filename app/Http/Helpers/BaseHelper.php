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
    public static function getDefaultRoutes(Model $entity, mixed $actions)
    {
        $prepared = is_array($actions) ? $actions : [$actions];
        $prefix = self::getPrefix($entity);
        return collect($prepared)
            ->mapWithKeys(function ($action) use ($prefix, $entity) {
                if (in_array($action, self::$dynamicRoutes)) {
                    if (!$entity->exists) {
                        throw new \LogicException("Dynamic route {$action} requirs persistent model");
                    }
                    return [$action => route("{$prefix}.{$action}", $entity->id)];
                }
                throw new \InvalidArgumentException("Wrong route name - $action");
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