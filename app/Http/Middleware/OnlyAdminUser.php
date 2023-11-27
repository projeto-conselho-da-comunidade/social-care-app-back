<?php

namespace App\Http\Middleware;

use App\Enums\RolesEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class OnlyAdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (current_user()->hasRole(RolesEnum::ADMIN->value)) {
            return $next($request);
        }

        return response()->json([
            'message' => __('messages.auth.access_denied')
        ], HttpResponse::HTTP_FORBIDDEN);
    }
}
