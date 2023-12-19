<?php

declare(strict_types=1);

namespace App\Entities;

/**
 * Class Employee
 */
final class Employee extends Entity
{
    private const NAME = 'Employee';

    /**
     * @param  int  $id
     * @return self|null
     */
    public static function getById(int $id): ?self
    {
        return new self($id, self::NAME);
    }
}
