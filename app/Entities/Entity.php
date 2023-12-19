<?php

declare(strict_types=1);

namespace App\Entities;

use App\Contracts\Entities\Entity as EntityContract;

abstract class Entity implements EntityContract
{
    /**
     * @param  int  $id
     * @param  string  $name
     */
    public function __construct(
        public int $id,
        public string $name
    ) {
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return sprintf('%s %d', $this->name, $this->id);
    }
}
