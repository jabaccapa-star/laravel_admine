<?php

namespace De\AdminAuth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdministrator
{
    /**
     * @param  Closure(Request): Response  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! method_exists($user, 'isAdministrator') || ! $user->isAdministrator()) {
            abort(403, 'Доступ только для администратора.');
        }

        return $next($request);
    }
}
