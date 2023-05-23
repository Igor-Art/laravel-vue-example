<?php

namespace App\Dto;

use Illuminate\Validation\Validator;

readonly abstract class BaseDto
{
    abstract public static function getRules(): array;

    final public static function create(Validator $validator): self
    {
        return new static(...$validator->validated());
    }
}
