<?php

declare(strict_types=1);

namespace App\Entities;

/**
 * Class Contractor
 */
final class Contractor extends Entity
{
    private const NAME = 'Contractor';

    private const EMAIL = 'example@example.com';

    private const IS_MOBILE = true;

    public string $email;

    public bool $isMobile;

    /**
     * @param  int  $id
     * @param  string  $name
     */
    public function __construct(public int $id, public string $name)
    {
        parent::__construct($id, $name);

        $this->email    = self::EMAIL;
        $this->isMobile = self::IS_MOBILE;
    }

    /**
     * @param  int  $id
     * @return self|null
     */
    public static function getById(int $id): ?self
    {
        return new self($id, self::NAME);
    }
}
