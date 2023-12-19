<?php

declare(strict_types=1);

namespace App\DTO\V1\Operation;

/**
 * Class ResponseDTO
 */
final readonly class ResponseDTO
{
    /**
     * @param  bool  $notificationEmployeeByEmail
     * @param  bool  $notificationClientByEmail
     * @param  NotificationClientBySmsDTO  $notificationEmployeeBySms
     */
    public function __construct(
        public bool $notificationEmployeeByEmail,
        public bool $notificationClientByEmail,
        public NotificationClientBySmsDTO $notificationEmployeeBySms,
    ) {
    }
}
