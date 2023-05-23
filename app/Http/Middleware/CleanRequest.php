<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\TransformsRequest;
use Illuminate\Http\Request;
use Mews\Purifier\Purifier;

final class CleanRequest extends TransformsRequest
{
    /**
     * @var array
     */
    private array $routeConfig;

    /**
     * @param Purifier $purifier
     * @param array $config
     */
    public function __construct(
        private Purifier $purifier,
        private readonly array $config
    ) {}

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->routeConfig = $this->getRouteConfig($request) ?? [];

        $this->clean($request);

        return $next($request);
    }

    /**
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    public function transform($key, $value): mixed
    {
        $config = $this->routeConfig[$key] ?? null;

        if ($config === null || is_string($config)) {
            $value = $this->purifier->clean($value, $config);
        }

        return $value;
    }

    /**
     * @param Request $request
     * @return array|null
     */
    private function getRouteConfig(Request $request): ?array
    {
        foreach ($this->config['routes'] as $url => $config) {
            if ($url !== '/') {
                $url = trim($url, '/');
            }

            if ($request->fullUrlIs($url) || $request->is($url)) {
                return $config;
            }
        }

        return null;
    }
}
