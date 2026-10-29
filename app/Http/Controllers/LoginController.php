<?php

namespace App\Http\Controllers;

use App\Models\RegisterStudent;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LoginController extends Controller
{
  public function show(): View
  {
    return view('login');
  }

  public function login(Request $request): JsonResponse
  {
    $validated = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required', 'string'],
    ]);

    $user = User::where('email', $validated['email'])->first();
    $student = RegisterStudent::where('email', $validated['email'])->first();

    if (!$user && $student && Hash::check($validated['password'], (string) $student->password)) {
      $studentRole = Role::whereRaw('LOWER(role_name) = ?', ['student'])->first();

      if (!$studentRole) {
        return response()->json([
          'status' => false,
          'message' => 'Student role is missing in roles table.'
        ], 500);
      }

      $user = User::create([
        'name' => $student->name,
        'email' => $student->email,
        'phone' => $student->mobile,
        'role' => strtolower($studentRole->role_name),
        'password' => $student->password,
        'image' => $student->photo,
        'email_verified_at' => now(),
      ]);
    }

    if (!$user || !Hash::check($validated['password'], (string) $user->password)) {
      return response()->json([
        'status' => false,
        'message' => 'Invalid email or password.'
      ], 401);
    }

    $roleName = strtolower(trim((string) $user->role));
    $roleExists = Role::whereRaw('LOWER(role_name) = ?', [$roleName])->exists();

    if (!$roleExists) {
      return response()->json([
        'status' => false,
        'message' => 'Assigned role is not available in roles table.'
      ], 403);
    }

    if ($user->is_block === 'Y') {
      return response()->json([
        'status' => false,
        'message' => 'Your account has been blocked. Please contact admin.'
      ], 403);
    }

    if ($roleName === 'student') {
      if (!$student) {
        $student = RegisterStudent::where('email', $validated['email'])->first();
      }

      if (!$student) {
        return response()->json([
          'status' => false,
          'message' => 'Student record not found.'
        ], 404);
      }

      if (($student->approval_status ?? 'Pending') !== 'Approved') {
        return response()->json([
          'status' => false,
          'message' => 'Your account is not approved yet. Please contact admin.'
        ], 403);
      }

      if (!Hash::check($validated['password'], (string) $student->password)) {
        return response()->json([
          'status' => false,
          'message' => 'Invalid email or password.'
        ], 401);
      }

      Auth::logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();
      $request->session()->regenerate();

      session([
        'logged_in_user_id' => $student->id,
        'logged_in_user_name' => $student->name,
        'logged_in_user_email' => $student->email,
        'logged_in_user_role' => 'student',
      ]);

      return response()->json([
        'status' => true,
        'message' => 'Student login successful.',
        'role' => 'student',
        'redirect' => route('student.dashboard')
      ]);
    }

    Auth::login($user, (bool) $request->boolean('remember'));
    $request->session()->regenerate();

    $redirect = $roleName === 'employee'
      ? route('employee.dashboard')
      : route('admin.dashboard');

    $message = ucfirst($roleName) . ' login successful.';

    return response()->json([
      'status' => true,
      'message' => $message,
      'role' => $roleName,
      'redirect' => $redirect
    ]);
  }

  public function logout(Request $request): JsonResponse
  {
    if (Auth::check()) {
      Auth::logout();
    }

    $request->session()->forget([
      'logged_in_user_id',
      'logged_in_user_name',
      'logged_in_user_email',
      'logged_in_user_role',
    ]);

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return response()->json([
      'status' => true,
      'message' => 'Logout successful.',
      'redirect' => route('login')
    ]);
  }
}
