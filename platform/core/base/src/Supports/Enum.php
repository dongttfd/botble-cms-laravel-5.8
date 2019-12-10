<?php

namespace Botble\Base\Supports;

use Lang;
use MyCLabs\Enum\Enum as MyCLabsEnum;

abstract class Enum extends MyCLabsEnum
{
    /**
     * @var string
     */
    protected static $langPath = 'core/base::enums';

    /**
     * @return string
     */
    public static function randomKey(): string
    {
        $keys = self::keys();

        return $keys[array_rand($keys)];
    }

    /**
     * @return string
     */
    public static function randomValue(): string
    {
        $values = self::values();

        return $values[array_rand($values)];
    }

    /**
     * @return string
     */
    public function label(): string
    {
        return self::getLabel($this->getValue());
    }

    /**
     * @return array
     */
    public static function labels(): array
    {
        $result = [];

        foreach (static::toArray() as $value) {
            $result[$value] = static::getLabel($value);
        }

        return $result;
    }

    /**
     * @param string $value
     * @return string
     */
    protected static function getLabel(string $value): string
    {
        $lang_key = sprintf(
            '%s.%s',
            static::$langPath,
            $value
        );

        return Lang::has($lang_key) ? trans($lang_key) : $value;
    }

    /**
     * @param $value
     * @return bool
     */
    public function is($value)
    {
        return $this->getValue() === ($value instanceof self ? $value->getValue() : $value);
    }

    /**
     * @param bool $include_default
     * @return array
     */
    public static function toArray(bool $include_default = false): array
    {
        $result = parent::toArray();

        if (isset($result['__default']) && !$include_default) {
            unset($result['__default']);
        }

        return $result;
    }

    /**
     * Returns all constants (possible values) as an array according to `SplEnum` class.
     * 
     * @param bool $include_default
     * @return array
     */
    public function getConstList(bool $include_default = false): array
    {
        return static::toArray($include_default);
    }
}
