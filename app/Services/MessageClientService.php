<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\Services\MessageClientService as MessageClientServiceContract;
use App\Enums\MessageType;
use App\Enums\NotificationEventStatus;
use App\Enums\Status;

/**
 * Class MessageClientService
 */
final class MessageClientService implements MessageClientServiceContract
{
    /**
     * @param  string  $from
     * @param  string  $to
     * @param  string  $subject
     * @param  string  $message
     * @param  int  $resellerId
     * @param  NotificationEventStatus  $status
     * @param  int|null  $clientId
     * @param  Status|null  $changedStatusTo
     * @param  MessageType  $type
     * @return void
     */
    public function send(
        string $from,
        string $to,
        string $subject,
        string $message,
        int $resellerId,
        NotificationEventStatus $status,
        ?int $clientId = null,
        ?Status $changedStatusTo = null,
        MessageType $type = MessageType::EMAIL
    ): void {
    }
}
