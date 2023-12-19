<?php

declare(strict_types=1);

namespace Tests\Feature\V1;

use App\Enums\NotificationType;
use App\Enums\Status;
use Tests\TestCase;

/**
 * Class OperationTest
 */
final class OperationTest extends TestCase
{
    /**
     * @return void
     */
    public function testSuccessCase(): void
    {
        $request = [
            'data' => [
                'resellerId'       => $this->faker->randomNumber(),
                'notificationType' => $this->faker->randomElement(NotificationType::getAllValues()),
                'clientId'         => $this->faker->randomNumber(),
                'creatorId'        => $this->faker->randomNumber(),
                'expertId'         => $this->faker->randomNumber(),
                'differences'      => [
                    'from' => $this->faker->randomElement(Status::getAllValues()),
                    'to'   => $this->faker->randomElement(Status::getAllValues()),
                ],
                'complaintId'       => $this->faker->randomNumber(),
                'complaintNumber'   => $this->faker->numerify,
                'consumptionId'     => $this->faker->randomNumber(),
                'consumptionNumber' => $this->faker->numerify,
                'agreementNumber'   => $this->faker->numerify,
                'date'              => $this->faker->date,
            ],
        ];

        $this->postJson(route('v1.operation'), $request)
            ->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'notificationEmployeeByEmail',
                    'notificationClientByEmail',
                    'notificationClientBySms' => [
                        'isSent',
                        'message',
                    ],
                ],
            ]);
    }
}
