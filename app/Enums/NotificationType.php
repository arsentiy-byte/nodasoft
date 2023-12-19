<?php

declare(strict_types=1);

namespace App\Enums;

use Core\Traits\EnumTrait;

/**
 * Enum NotificationType
 */
enum NotificationType: int
{
    use EnumTrait;

    case NEW    = 1;
    case CHANGE = 2;
}
