<?php

namespace App\Http\Requests\Games;

use App\Dto\Games\GameFilterDto;
use App\Http\Requests\FormRequest;

final class GameFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return GameFilterDto::getRules();
    }

    public function getDto(): GameFilterDto
    {
        return GameFilterDto::create($this->getValidatorInstance());
    }
}
