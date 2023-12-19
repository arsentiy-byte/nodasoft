<?php

declare(strict_types=1);

namespace Core\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class Resource
 */
abstract class Resource extends JsonResource
{
    /**
     * @return array
     */
    abstract public function getResponseArray(): array;

    /**
     * @param  Request  $request
     * @return array
     */
    final public function toArray(Request $request): array
    {
        return $this->getResponseArray();
    }
}
