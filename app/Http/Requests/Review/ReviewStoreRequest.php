<?php

namespace App\Http\Requests\Review;

use App\Dto\Review\ReviewStoreDto;
use App\Http\Requests\FormRequest;

class ReviewStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return ReviewStoreDto::getRules();
    }

    public function getDto(): ReviewStoreDto
    {
        return ReviewStoreDto::create($this->getValidatorInstance());
    }
}
