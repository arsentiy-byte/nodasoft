<?php

declare(strict_types=1);

namespace App\Contracts\Services;

use App\Enums\NotificationEventStatus;
use App\Enums\Status;

/**
 * Interface NotificationManagerService
 */
interface NotificationManagerService
{
    /**
     * @param  int  $resellerId
     * @param  int  $clientId
     * @param  NotificationEventStatus  $status
     * @param  Status|null  $changeStatusTo
     * @param  array  $templateData
     * @param  string|null  $error
     * @return bool
     */
    public function send(
        int $resellerId,
        int $clientId,
        NotificationEventStatus $status,
        ?Status $changeStatusTo,
        array $templateData,
        ?string &$error
    ): bool;
}
