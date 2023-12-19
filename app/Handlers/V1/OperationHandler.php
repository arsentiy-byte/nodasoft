<?php

declare(strict_types=1);

namespace App\Handlers\V1;

use App\Contracts\Services\MessageClientService;
use App\Contracts\Services\NotificationManagerService;
use App\DTO\V1\Operation\NotificationClientBySmsDTO;
use App\DTO\V1\Operation\RequestDTO;
use App\DTO\V1\Operation\ResponseDTO;
use App\Enums\NotificationEvent;
use App\Enums\NotificationEventStatus;
use App\Enums\NotificationType;
use Core\Traits\ConfigTrait;

/**
 * Class OperationHandler
 */
final readonly class OperationHandler
{
    use ConfigTrait;

    /**
     * @param  GetEmailsByPermitHandler  $getEmailsByPermitHandler
     * @param  MessageClientService  $messageClientService
     * @param  NotificationManagerService  $notificationManagerService
     */
    public function __construct(
        private GetEmailsByPermitHandler $getEmailsByPermitHandler,
        private MessageClientService $messageClientService,
        private NotificationManagerService $notificationManagerService
    ) {
    }

    /**
     * @param  RequestDTO  $dto
     * @return ResponseDTO
     */
    public function handle(RequestDTO $dto): ResponseDTO
    {
        $notificationEmployeeByEmail    = false;
        $notificationClientByEmail      = false;
        $notificationClientBySmsSent    = false;
        $notificationClientBySmsMessage = null;

        $differences  = $this->getDifferences($dto);
        $templateData = $this->getTemplateData($dto, $differences);

        $emailFrom = $this->getResellerEmailFrom();
        $emails    = $this->getEmailsByPermitHandler
            ->handle(
                $dto->resellerId,
                NotificationEvent::TS_GOOD_RETURN
            );

        foreach ($emails as $email) {
            $this->messageClientService->send(
                from: $emailFrom,
                to: $email,
                subject: __('complaintEmployeeEmailSubject', [
                    'templateData' => json_encode($templateData),
                    'resellerId'   => $dto->resellerId,
                ]),
                message: __('complaintEmployeeEmailBody', [
                    'templateData' => json_encode($templateData),
                    'resellerId'   => $dto->resellerId,
                ]),
                resellerId: $dto->resellerId,
                status: NotificationEventStatus::CHANGE_RETURN
            );
            $notificationEmployeeByEmail = true;
        }

        if (NotificationType::CHANGE === $dto->notificationType) {
            $this->messageClientService->send(
                $emailFrom,
                $dto->client->email,
                __('complaintClientEmailSubject', [
                    'templateData' => json_encode($templateData),
                    'resellerId'   => $dto->resellerId,
                ]),
                __('complaintClientEmailBody', [
                    'templateData' => json_encode($templateData),
                    'resellerId'   => $dto->resellerId,
                ]),
                $dto->resellerId,
                NotificationEventStatus::CHANGE_RETURN,
                $dto->client->id,
                $dto->differencesTo
            );

            $notificationClientByEmail = true;

            if ($dto->client->isMobile) {
                $notificationClientBySmsSent = $this->notificationManagerService
                    ->send(
                        $dto->resellerId,
                        $dto->client->id,
                        NotificationEventStatus::CHANGE_RETURN,
                        $dto->differencesTo,
                        $templateData,
                        $notificationClientBySmsMessage
                    );
            }
        }

        return new ResponseDTO(
            $notificationEmployeeByEmail,
            $notificationClientByEmail,
            new NotificationClientBySmsDTO(
                $notificationClientBySmsSent,
                $notificationClientBySmsMessage
            ),
        );
    }

    /**
     * @param  RequestDTO  $dto
     * @return string
     */
    private function getDifferences(RequestDTO $dto): string
    {
        return match ($dto->notificationType) {
            NotificationType::NEW => __('NewPositionAdded', [
                'resellerId'  => $dto->resellerId,
                'differences' => null,
            ]),
            NotificationType::CHANGE => __('PositionStatusHasChanged', [
                'resellerId'       => $dto->resellerId,
                'differences_from' => $dto->differencesFrom?->title(),
                'differences_to'   => $dto->differencesTo?->title(),
            ])
        };
    }

    /**
     * @param  RequestDTO  $dto
     * @param  string  $differences
     * @return array
     */
    private function getTemplateData(RequestDTO $dto, string $differences): array
    {
        return [
            'COMPLAINT_ID'       => $dto->complaintId,
            'COMPLAINT_NUMBER'   => $dto->complaintNumber,
            'CREATOR_ID'         => $dto->creator->id,
            'CREATOR_NAME'       => $dto->creator->getFullName(),
            'EXPERT_ID'          => $dto->expert->id,
            'EXPERT_NAME'        => $dto->expert->getFullName(),
            'CLIENT_ID'          => $dto->client->id,
            'CLIENT_NAME'        => $dto->client->getFullName(),
            'CONSUMPTION_ID'     => $dto->consumptionId,
            'CONSUMPTION_NUMBER' => $dto->consumptionNumber,
            'AGREEMENT_NUMBER'   => $dto->agreementNumber,
            'DATE'               => $dto->date->toDateString(),
            'DIFFERENCES'        => $differences,
        ];
    }
}
