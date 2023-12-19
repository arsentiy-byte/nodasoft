<?php

declare(strict_types=1);

namespace App\Providers;

use App\Contracts\Services\MessageClientService as MessageClientServiceContract;
use App\Contracts\Services\NotificationManagerService as NotificationManagerServiceContract;
use App\Services\MessageClientService;
use App\Services\NotificationManagerService;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class ServiceProvider
 */
final class ServiceProvider extends BaseServiceProvider
{
    /**
     * @var string[]
     */
    public array $bindings = [
        MessageClientServiceContract::class       => MessageClientService::class,
        NotificationManagerServiceContract::class => NotificationManagerService::class,
    ];
}
