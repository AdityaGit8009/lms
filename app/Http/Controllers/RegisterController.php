<?php

namespace App\Http\Controllers;

use App\Models\RegisterStudent;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegisterController extends Controller
{
  public function show(): View
  {
    return view('register');
  }

  public function register(Request $request): JsonResponse
  {
    $validated = $request->validate([
      'name'     => ['required', 'regex:/^[A-Za-z\s]{3,50}$/'],
      'college'  => ['required', 'string', 'max:100'],
      'regno'    => ['required', 'string', 'min:5', 'max:15', 'unique:tbl_register,regno'],
      'course'   => ['required', 'string'],
      'branch'   => ['required', 'string', 'max:100'],
      'year'     => ['required', 'string', 'max:20'],
      'mobile'   => ['required', 'regex:/^[6-9]\d{9}$/', 'unique:tbl_register,mobile'],
      'email'    => ['required', 'email', 'max:255', 'unique:tbl_register,email', 'unique:users,email'],
      'gender'   => ['required', Rule::in(['male', 'female'])],
      'password' => ['required', 'string', 'min:6', 'max:20'],
      'pro'      => ['required', 'string'],
      'location' => ['required', 'string', 'max:255'],
      'pic'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
    ]);

    DB::beginTransaction();

    try {
      $studentRole = Role::whereRaw('LOWER(role_name) = ?', ['student'])->first();

      if (!$studentRole) {
        throw new \RuntimeException('Student role not found in roles table.');
      }

      $photoPath = null;
      if ($request->hasFile('pic')) {
        $photoPath = $request->file('pic')->store('students', 'public');
      }

      $hashedPassword = Hash::make($validated['password']);

      RegisterStudent::create([
        'name'            => trim($validated['name']),
        'college'         => trim($validated['college']),
        'regno'           => trim($validated['regno']),
        'course'          => $validated['course'],
        'branch'          => trim($validated['branch']),
        'year'            => trim($validated['year']),
        'mobile'          => $validated['mobile'],
        'email'           => strtolower(trim($validated['email'])),
        'password'        => $hashedPassword,
        'gender'          => strtolower($validated['gender']),
        'program'         => $validated['pro'],
        'location'        => trim($validated['location']),
        'photo'           => $photoPath,
        'approval_status' => 'Pending',
      ]);

      User::create([
        'name'              => trim($validated['name']),
        'email'             => strtolower(trim($validated['email'])),
        'phone'             => $validated['mobile'],
        'role'              => strtolower($studentRole->role_name),
        'password'          => $hashedPassword,
        'image'             => $photoPath,
        'email_verified_at' => now(),
      ]);

      DB::commit();

      return response()->json([
        'status'  => true,
        'message' => 'Registration successful. Your account is pending admin approval.'
      ], 201);
    } catch (\Throwable $e) {
      DB::rollBack();

      return response()->json([
        'status'  => false,
        'message' => 'Registration failed.',
        'error'   => $e->getMessage()
      ], 500);
    }
  }
}
