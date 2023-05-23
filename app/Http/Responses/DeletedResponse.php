<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

class DeletedResponse implements Responsable
{
    public function toResponse($request): Response
    {
        return response()->noContent(204);
    }
}
