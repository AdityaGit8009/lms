<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
        'password',
        'image',
        'is_block',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roleRecord()
    {
        return $this->belongsTo(Role::class, 'role', 'role_name');
    }

    public function getNormalizedRoleAttribute(): string
    {
        return strtolower(trim((string) $this->attributes['role'] ?? ''));
    }

    public function isAdmin(): bool
    {
        return $this->normalized_role === 'admin';
    }

    public function isEmployee(): bool
    {
        return $this->normalized_role === 'employee';
    }

    public function isStudent(): bool
    {
        return $this->normalized_role === 'student';
    }
}
