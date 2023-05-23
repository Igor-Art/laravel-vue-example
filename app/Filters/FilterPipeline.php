<?php

namespace App\Filters;

use Illuminate\Pipeline\Pipeline;

final class FilterPipeline extends Pipeline
{
    private FilterRequest $request;

    public function setRequest(FilterRequest $request): self
    {
        $this->request = $request;

        return $this;
    }

    protected function parsePipeString($pipe): array
    {
        [$name, $parameters] = parent::parsePipeString($pipe);

        array_unshift($parameters, $this->request);

        return [$name, $parameters];
    }
}
