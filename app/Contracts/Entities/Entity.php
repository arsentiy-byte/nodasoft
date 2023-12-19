<?php

declare(strict_types=1);

namespace App\Contracts\Entities;

/**
 * Interface Entity
 */
interface Entity
{
    /**
     * @param  int  $id
     * @return self|null
     */
    public static function getById(int $id): ?self;

    /**
     * @return string
     */
    public function getFullName(): string;
}
