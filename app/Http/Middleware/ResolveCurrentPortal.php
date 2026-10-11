<?php

namespace App\Http\Middleware;

use App\Context\CurrentPortal;
use App\Models\Portal;
use App\Services\RedisCacheService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResolveCurrentPortal
{
    public function __construct(
        private readonly RedisCacheService $cache
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentPortal = app(CurrentPortal::class);

        $routePortal = $request->route('portal');

        if (! $routePortal) {
            return $next($request);
        }

        $portal = $routePortal instanceof Portal ? $routePortal
            : $this->cache->remember(
                "portal:{$routePortal}",
                fn () => Portal::query()->whereKey($routePortal)->value('id'),
                3600
            );

        $currentPortal->set($portal);

        return $next($request);
    }
}
