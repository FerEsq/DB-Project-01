<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Profile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->route()->getName() !== 'profile.index') {
            $user = auth()->user();
            if (!$user->franchise_id || !$user->gender_id || !$user->position_id || !$user->born_at || !$user->started_at) {
                $request->session()->flash('message', trans("To continue you need to fill out your profile"));
                $request->session()->flash('type', 'warning');

                return redirect()->route('profile.index');
            }
        }

        return $next($request);
    }
}
