<?php

namespace App\Http\Middleware;

use App\Models\Portal;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePortalFeatureIsEnabled
{
    /**
     * Reject requests for a feature that is disabled in the current portal.
     *
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next, string $feature): Response
    {
        $portal = $request->route('portal');

        if (! $portal instanceof Portal || ! $portal->features()
            ->where('feature', $feature)
            ->where('enabled', true)
            ->exists()) {
            abort(404);
        }

        return $next($request);
    }
}
