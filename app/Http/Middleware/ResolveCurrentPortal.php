<?php

namespace App\Http\Middleware;

use App\Context\CurrentPortal;
use App\Models\Portal;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class ResolveCurrentPortal
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, CurrentPortal $currentPortal): Response
    {
        $routePortal = $request->route('portal');

        if (! $routePortal) {
            return $next($request);
        }

        $portal = $routePortal instanceof Portal ? $routePortal
            : Cache::remember(
                "portal:{$routePortal}",
                now()->addHour(),
                fn () => Portal::query()
                    ->findOrFail($routePortal)
            );

        $currentPortal->set($portal);

        return $next($request);
    }
}
