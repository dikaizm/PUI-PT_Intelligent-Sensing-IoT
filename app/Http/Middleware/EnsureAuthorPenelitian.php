<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Penelitian;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAuthorPenelitian
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $penelitian = Penelitian::where('uuid', $request->uuid)->first();
        $user = auth()->user();

        if (
            $user->hasRole('Admin') ||
            ($penelitian &&
                $penelitian
                    ->users()
                    ->where('user_id', $user->id)
                    ->exists())
        ) {
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
