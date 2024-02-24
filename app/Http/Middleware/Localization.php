<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        \Log::info('Localization middleware');
        if ($request->session()->has('locale')) {
            \Log::info($request->session()->get('locale'));
            app()->setLocale($request->session()->get('locale'));
        }

        return $next($request);
    }
}
