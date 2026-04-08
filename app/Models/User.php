<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_EDITOR = 'editor';
    public const PROTECTED_EMAIL = 'admin@cadde1905.test';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_super_admin',
        'is_active',
        'can_write',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_super_admin' => 'boolean',
            'is_active' => 'boolean',
            'can_write' => 'boolean',
        ];
    }

    public function canWrite(): bool
    {
        return (bool) ($this->can_write ?? true);
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isEditor(): bool
    {
        return $this->role === self::ROLE_EDITOR;
    }

    public function isSuperAdmin(): bool
    {
        return (bool) $this->is_super_admin;
    }

    public function isProtectedAccount(): bool
    {
        return $this->email === self::PROTECTED_EMAIL || $this->id === 1;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        return in_array($this->role, [self::ROLE_ADMIN, self::ROLE_EDITOR], true);
    }
}
