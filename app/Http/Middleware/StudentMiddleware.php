<?php

namespace App\Http\Middleware;

use App\Models\RegisterStudent;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
  public function handle(Request $request, Closure $next): Response
  {
    if (!Auth::check()) {
      return redirect()->route('login');
    }

    $user = $request->user();
    if (strtolower(trim((string) $user->role)) !== 'student') {
      abort(403, 'Unauthorized access.');
    }

    $registration = RegisterStudent::where('email', $user->email)->first();
    if ($user->is_block === 'Y' || $registration?->approval_status !== 'Approved') {
      Auth::logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect()->route('login')->with('error', 'An active, approved student account is required.');
    }

    $request->attributes->set('studentRegistration', $registration);

    return $next($request);
  }
}
