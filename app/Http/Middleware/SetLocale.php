<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Supported locales.
     */
    protected array $supported = ['en', 'id'];

    /**
     * Handle an incoming request.
     * Priority: session > browser Accept-Language > app default
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. If user has manually chosen a locale in the session, use that
        if ($locale = session('locale')) {
            if (in_array($locale, $this->supported)) {
                app()->setLocale($locale);
                return $next($request);
            }
        }

        // 2. Detect from browser Accept-Language header
        $preferred = $request->getPreferredLanguage($this->supported);

        if ($preferred) {
            app()->setLocale($preferred);
        }

        return $next($request);
    }
}
