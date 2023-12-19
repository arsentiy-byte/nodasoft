<?php

declare(strict_types=1);

namespace App\DTO\V1\Operation;

use App\Entities\Contractor;
use App\Entities\Employee;
use App\Enums\NotificationType;
use App\Enums\Status;
use Carbon\CarbonImmutable;

/**
 * Class OperationRequestDTO
 */
final readonly class RequestDTO
{
    /**
     * @param  int  $resellerId
     * @param  NotificationType  $notificationType
     * @param  Contractor  $client
     * @param  Employee  $creator
     * @param  Employee  $expert
     * @param  Status|null  $differencesFrom
     * @param  Status|null  $differencesTo
     * @param  int  $complaintId
     * @param  string  $complaintNumber
     * @param  int  $consumptionId
     * @param  string  $consumptionNumber
     * @param  string  $agreementNumber
     * @param  CarbonImmutable  $date
     */
    public function __construct(
        public int $resellerId,
        public NotificationType $notificationType,
        public Contractor $client,
        public Employee $creator,
        public Employee $expert,
        public ?Status $differencesFrom,
        public ?Status $differencesTo,
        public int $complaintId,
        public string $complaintNumber,
        public int $consumptionId,
        public string $consumptionNumber,
        public string $agreementNumber,
        public CarbonImmutable $date,
    ) {
    }
}
