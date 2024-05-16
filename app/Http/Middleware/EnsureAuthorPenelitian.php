<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Penelitian;

class EnsureAuthorPenelitian
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Retrieve the Penelitian model based on the UUID from the request
        $penelitian = Penelitian::where('uuid', $request->uuid)->first();

        // Get the authenticated user
        $user = auth()->user();

        // Check if the user has the 'Admin' role or if the user is associated with the Penelitian
        if (
            $user->hasRole('Admin') ||
            ($penelitian && $penelitian->users()->where('user_id', $user->id)->exists())
        ) {
            // If the conditions are met, proceed with the next middleware or request
            return $next($request);
        }

        // If the user is not authorized, return a view with a 403 status code
        return response()->view('errors.403', [], 403);
    }
}
