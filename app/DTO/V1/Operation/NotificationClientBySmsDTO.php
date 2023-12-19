<?php

declare(strict_types=1);

namespace App\DTO\V1\Operation;

/**
 * Class NotificationClientBySmsDTO
 */
final readonly class NotificationClientBySmsDTO
{
    /**
     * @param  bool  $isSent
     * @param  string|null  $message
     */
    public function __construct(
        public bool $isSent,
        public ?string $message
    ) {
    }
}
