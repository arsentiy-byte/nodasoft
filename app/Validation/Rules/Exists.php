<?php

declare(strict_types=1);

namespace App\Validation\Rules;

use App\Contracts\Entities\Entity;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use RuntimeException;

/**
 * Class Exists
 */
final class Exists implements ValidationRule
{
    /**
     * @template T of Entity
     *
     * @param  class-string<T>  $class
     */
    public function __construct(
        public string $class
    ) {
    }

    /**
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ( ! array_key_exists(Entity::class, class_implements($this->class))) {
            throw new RuntimeException(
                sprintf('Class %s must be an instance of %s', $this->class, Entity::class)
            );
        }

        if (null === $this->class::getById($value)) {
            $fail(sprintf('%s does not exist', $attribute));
        }
    }
}
