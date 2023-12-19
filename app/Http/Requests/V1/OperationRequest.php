<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use App\DTO\V1\Operation\RequestDTO;
use App\Entities\Contractor;
use App\Entities\Employee;
use App\Entities\Seller;
use App\Enums\NotificationType;
use App\Enums\Status;
use App\Validation\Rules\Exists;
use Carbon\CarbonImmutable;
use Core\Http\Requests\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rules\Enum;

/**
 * Class OperationRequest
 */
final class OperationRequest extends FormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'data'                   => ['required', 'array'],
            'data.resellerId'        => ['required', 'integer', new Exists(Seller::class)],
            'data.notificationType'  => ['required', 'integer', new Enum(NotificationType::class)],
            'data.clientId'          => ['required', 'integer', new Exists(Contractor::class)],
            'data.creatorId'         => ['required', 'integer', new Exists(Employee::class)],
            'data.expertId'          => ['required', 'integer', new Exists(Employee::class)],
            'data.differences'       => ['nullable', 'array'],
            'data.differences.from'  => ['nullable', 'integer', new Enum(Status::class)],
            'data.differences.to'    => ['nullable', 'integer', new Enum(Status::class)],
            'data.complaintId'       => ['required', 'integer'],
            'data.complaintNumber'   => ['required', 'string'],
            'data.consumptionId'     => ['required', 'integer'],
            'data.consumptionNumber' => ['required', 'string'],
            'data.agreementNumber'   => ['required', 'string'],
            'data.date'              => ['required', 'date'],
        ];
    }

    /**
     * @return RequestDTO
     */
    public function getDto(): RequestDTO
    {
        $data        = $this->validated('data');
        $differences = Arr::get($data, 'differences', []);
        $from        = Arr::get($differences, 'from');
        $to          = Arr::get($differences, 'to');

        return new RequestDTO(
            (int) Arr::get($data, 'resellerId'),
            NotificationType::from((int) Arr::get($data, 'notificationType')),
            Contractor::getById((int) Arr::get($data, 'clientId')),
            Employee::getById((int) Arr::get($data, 'creatorId')),
            Employee::getById((int) Arr::get($data, 'expertId')),
            null !== $from ? Status::from((int) $from) : null,
            null !== $to ? Status::from((int) $to) : null,
            (int) Arr::get($data, 'complaintId'),
            Arr::get($data, 'complaintNumber'),
            (int) Arr::get($data, 'consumptionId'),
            Arr::get($data, 'consumptionNumber'),
            Arr::get($data, 'agreementNumber'),
            CarbonImmutable::parse(Arr::get($data, 'date'))
        );
    }
}
