<?php

declare(strict_types=1);

namespace App\Entities;

/**
 * Class Seller
 */
final class Seller extends Entity
{
    private const NAME = 'Seller';

    /**
     * @param  int  $id
     * @return self|null
     */
    public static function getById(int $id): ?self
    {
        return new self($id, self::NAME);
    }
}
