<?php

declare(strict_types=1);

namespace Core\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

/**
 * Class Handler
 */
final class Handler extends ExceptionHandler
{
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable((new DefaultExceptionParser())->renderable());
    }
}
