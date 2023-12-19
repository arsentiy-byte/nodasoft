<?php

declare(strict_types=1);

namespace Core\Traits;

use BackedEnum;

/**
 * @mixin BackedEnum
 */
trait EnumTrait
{
    /**
     * @return array
     */
    public static function getAllValues(): array
    {
        return array_column(static::cases(), 'value');
    }

    /**
     * @param  array  $from
     * @return array
     */
    public static function make(array $from): array
    {
        $result = [];

        /** @var string $value */
        foreach ($from as $value) {
            $result[] = self::from($value);
        }

        return $result;
    }
}
