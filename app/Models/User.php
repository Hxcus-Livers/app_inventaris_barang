<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verified_at',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    /**
     * Check if user is an admin
     */
    public function isAdmin()
    {
        return $this->role === 0;
    }

    /**
     * Check if the user is an accountant
     *
     * @return bool
     */
    public function isAccountant()
    {
        return $this->role === 1;
    }


    /**
     * Get role name
     */
    public function getRoleName(): string
    {
        return match($this->role) {
            0 => 'Admin',
            1 => 'Accountant',
            default => 'User',
        };
    }

    /**
     * Check if user has specific role
     */
    public function hasRole(int|array $roles): bool
    {
        if (is_array($roles)) {
            return in_array($this->role, $roles);
        }
        
        return $this->role === $roles;
    }
}
