<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * Enum NotificationEvent
 */
enum NotificationEventStatus: string
{
    case CHANGE_RETURN = 'changeReturnStatus';
    case NEW_RETURN    = 'newReturnStatus';
}
