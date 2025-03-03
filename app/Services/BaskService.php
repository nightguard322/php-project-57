<?php

namespace App\Http\Services;

use Illuminate\Support\Str;

class BaseService
{
    
    













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
            'Service',
            '',
            class_basename(static::class)
        );
    }
}