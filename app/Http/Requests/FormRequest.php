<?php

namespace App\Http\Requests;

use App\Dto\BaseDto;

abstract class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    abstract public function rules(): array;

    abstract public function getDto(): BaseDto;

    final public function authorize(): bool
    {
        return true;
    }
}
