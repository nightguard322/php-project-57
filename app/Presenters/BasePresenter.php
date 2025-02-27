<?php

namespace App\Presenters;

use Illuminate\Support\Str;
use FormHelper;

abstract class BasePresenter
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    abstract public function present();

    /**
     * @get meta information with headers
     *
     * @param [type] $headers
     * @return array
     */
    public function __get($name)
    {
        if ($name === 'data') {
            return $this->data;
        }
        throw new \Exception("Property {$name} does not exists");
    }

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






    protected function prepareCollection($collection, callable $fn)
    {
        return $collection->map($fn)->toArray();
    }
}