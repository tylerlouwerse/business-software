<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class RequireAppSetup
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check cache first - if app is already set up, skip the query
        $appSetup = Cache::rememberForever('app.setup.completed', function () {
            return User::count() > 0;
        });

        // If app hasn't been initialized (no users exist)
        if (!$appSetup) {
            // Exclude setup routes to prevent redirect loops
            if (!$request->is('setup/*')) {
                return redirect()->route('setup.admin.show');
            }
        }

        return $next($request);
    }
}
