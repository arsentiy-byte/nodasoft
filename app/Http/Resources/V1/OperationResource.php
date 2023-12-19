<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use App\DTO\V1\Operation\ResponseDTO;
use Core\Http\Resources\Resource;

/**
 * Class OperationResource
 *
 * @mixin ResponseDTO
 */
final class OperationResource extends Resource
{
    /**
     * @return array
     */
    public function getResponseArray(): array
    {
        return [
            'notificationEmployeeByEmail' => $this->notificationEmployeeByEmail,
            'notificationClientByEmail'   => $this->notificationClientByEmail,
            'notificationClientBySms'     => [
                'isSent'  => $this->notificationEmployeeBySms->isSent,
                'message' => $this->notificationEmployeeBySms->message,
            ],
        ];
    }
}
