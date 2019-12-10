<?php

namespace Botble\Base\Traits;

use Botble\Base\Supports\Enum;

/**
 * Trait EnumCastable
 * @package Botble\Base\Traits
 * @mixin \Illuminate\Database\Eloquent\Concerns\HasAttributes
 */
trait EnumCastable
{
    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    protected function castAttribute($key, $value)
    {
        $castedValue = parent::castAttribute($key, $value);

        if ($castedValue === $value && !is_object($value)) {
            $cast_type = $this->getCasts()[$key];
            if (class_exists($cast_type) and is_subclass_of($cast_type, Enum::class)) {
                $castedValue = new $cast_type($value);
            }
        }

        return $castedValue;
    }
}