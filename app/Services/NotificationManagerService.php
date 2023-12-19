<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\NotificationManagerService as NotificationManagerServiceContract;
use App\Enums\NotificationEventStatus;
use App\Enums\Status;

/**
 * Class NotificationManagerService
 */
final class NotificationManagerService implements NotificationManagerServiceContract
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
    ): bool {
        $error = null;

        return true;
    }
}
