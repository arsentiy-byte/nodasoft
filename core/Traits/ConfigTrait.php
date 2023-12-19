<?php

declare(strict_types=1);

namespace Core\Traits;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

/**
 * Trait ConfigTrait
 */
trait ConfigTrait
{
    /**
     * @return bool
     */
    protected function isTestingEnvironment(): bool
    {
        return (bool) App::environment('testing');
    }

    /**
     * @return bool
     */
    protected function isProductionEnvironment(): bool
    {
        return App::isProduction();
    }

    /**
     * @return bool|string
     */
    protected function getEnvironment(): bool|string
    {
        return App::environment();
    }

    /**
     * @return string
     */
    protected function getProject(): string
    {
        return Config::get('app.name');
    }

    /**
     * @return string
     */
    protected function getResellerEmailFrom(): string
    {
        return Config::get('nodasoft.reseller_email_from');
    }
}
