<?php

declare(strict_types=1);

namespace App\Handlers\V1;

use App\Enums\NotificationEvent;

/**
 * Class GetEmailsByPermitHandler
 */
final class GetEmailsByPermitHandler
{
    /**
     * @param  int  $resellerId
     * @param  NotificationEvent  $event
     * @return string[]
     */
    public function handle(int $resellerId, NotificationEvent $event): array
    {
        return ['someemeil@example.com', 'someemeil2@example.com'];
    }
}
