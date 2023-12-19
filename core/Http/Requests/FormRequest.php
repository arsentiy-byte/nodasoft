<?php

declare(strict_types=1);

namespace Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

/**
 * Class FormRequest - базовый класс для запросов
 */
abstract class FormRequest extends BaseFormRequest
{
    /**
     * @return array
     */
    abstract public function rules(): array;
}
