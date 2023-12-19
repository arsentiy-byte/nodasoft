<?php

declare(strict_types=1);

namespace Core\Exceptions;

use Closure;
use Core\Traits\ConfigTrait;
use Core\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

/**
 * Class DefaultExceptionParser
 */
final class DefaultExceptionParser
{
    use ConfigTrait, ResponseTrait;

    /**
     * @return Closure
     */
    public function renderable(): Closure
    {
        return fn (Throwable $exception, $request): JsonResponse => $this->render($exception, $request);
    }

    /**
     * @param  Throwable  $e
     * @param  Request  $request
     * @return JsonResponse
     */
    public function render(Throwable $e, Request $request): JsonResponse
    {
        $errorCode = $e->getCode();

        if ( ! in_array($errorCode, [
            Response::HTTP_BAD_REQUEST,
            Response::HTTP_UNAUTHORIZED,
            Response::HTTP_FORBIDDEN,
            Response::HTTP_NOT_ACCEPTABLE,
            Response::HTTP_UNPROCESSABLE_ENTITY,
            Response::HTTP_NOT_FOUND,
            Response::HTTP_INTERNAL_SERVER_ERROR,
        ])) {
            $errorCode = Response::HTTP_BAD_REQUEST;
        }

        try {
            $e->getMessage();
        } catch (Throwable $t) {
            throw new RuntimeException(Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR]);
        }

        switch (true) {
            case $e instanceof NotFoundHttpException:
                return $this->errorResponse(
                    Response::$statusTexts[Response::HTTP_NOT_FOUND],
                    Response::HTTP_NOT_FOUND
                );
            case $e instanceof ValidationException:
                /** @var Validator $validator */
                $validator = $e->validator;

                return $this->errorResponse(
                    implode(', ', $validator->messages()->all()),
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            default:
                if (self::isProductionEnvironment()) {
                    return $this->errorResponse(
                        Response::$statusTexts[Response::HTTP_INTERNAL_SERVER_ERROR],
                        Response::HTTP_INTERNAL_SERVER_ERROR
                    );
                }

                return $this->errorResponse($e->getMessage(), $errorCode);
        }
    }
}
