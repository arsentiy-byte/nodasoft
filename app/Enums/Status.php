<?php

declare(strict_types=1);

namespace App\Enums;

use Core\Traits\EnumTrait;

/**
 * Enum Status
 */
enum Status: int
{
    use EnumTrait;

    case COMPLETED = 0;
    case PENDING   = 1;
    case REJECTED  = 2;

    /**
     * @return string
     */
    public function title(): string
    {
        return match ($this) {
            self::COMPLETED => 'Completed',
            self::PENDING   => 'Pending',
            self::REJECTED  => 'Rejected',
        };
    }
}
