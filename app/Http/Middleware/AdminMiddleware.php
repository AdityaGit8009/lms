<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
  public function handle(Request $request, Closure $next, string ...$roles): Response
  {
    if (!Auth::check()) {
      return redirect()->route('login');
    }

    $role = strtolower(trim((string) $request->user()->role));
    if (!in_array($role, $roles ?: ['admin'], true) || $request->user()->is_block === 'Y') {
      abort(403, 'Unauthorized access.');
    }

    return $next($request);
  }
}
