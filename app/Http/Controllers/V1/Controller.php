<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Handlers\V1\OperationHandler;
use App\Http\Requests\V1\OperationRequest;
use App\Http\Resources\V1\OperationResource;
use Core\Http\Controllers\Controller as BaseController;
use Illuminate\Http\JsonResponse;

/**
 * Class Controller
 */
final class Controller extends BaseController
{
    /**
     * @param  OperationRequest  $request
     * @param  OperationHandler  $handler
     * @return JsonResponse
     */
    public function operation(OperationRequest $request, OperationHandler $handler): JsonResponse
    {
        return $this->response(
            'Notifications are successfully sent',
            new OperationResource($handler->handle($request->getDto()))
        );
    }
}
