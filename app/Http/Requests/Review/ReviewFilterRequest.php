<?php

namespace App\Http\Requests\Review;

use App\Dto\Review\ReviewFilterDto;
use App\Http\Requests\FormRequest;

final class ReviewFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return ReviewFilterDto::getRules();
    }

    public function getDto(): ReviewFilterDto
    {
        return ReviewFilterDto::create($this->getValidatorInstance());
    }
}
