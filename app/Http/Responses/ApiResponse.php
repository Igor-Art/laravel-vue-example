<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

abstract class ApiResponse implements Responsable
{
    private ?string $message = null;
    private mixed $payload = null;
    private int $status = 200;

    public function toResponse($request): JsonResponse
    {
        return response()->json($this->getData(), $this->status);
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function setPayload(mixed $payload): self
    {
        $this->payload = $payload;

        return $this;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    private function getData(): array
    {
        return array_filter([
            'message' => $this->message,
            'payload' => $this->payload,
        ]);
    }
}
