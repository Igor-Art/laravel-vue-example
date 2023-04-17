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

    protected function prepareForValidation(): void
    {
        $this->replace([
            'genres' => $this->genres ? explode(',', $this->genres) : null,
            'is_free' => filter_var($this->is_free, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
        ]);
    }
}
