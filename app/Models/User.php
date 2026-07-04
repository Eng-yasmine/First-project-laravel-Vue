<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\RoleName;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Fortify\Contracts\PasskeyUser;
use Laravel\Fortify\PasskeyAuthenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property Carbon|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable implements PasskeyUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, PasskeyAuthenticatable, TwoFactorAuthenticatable;

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
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    public function hasRole(string $roleName): bool
    {
        return $this->roles()->where('name', $roleName)->exists();
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin(): bool
    {
        return $this->hasRole(RoleName::ADMIN->value);
    }

    public function isVendor(): bool
    {
        return $this->hasRole(RoleName::VENDOR->value);
    }

    public function isCustomer(): bool
    {
        return $this->hasRole(RoleName::CUSTOMER->value);
    }

    public function isStaff(): bool
    {
        return $this->hasRole(RoleName::STAFF->value);
    }

    public function permissions()
    {
        return $this->roles->with('permissions')->get()
         ->map(function ($role) {
                return $role->permissions->pluck('name');
            })->flatten()->values()->unique()->toArray();
    }

     public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->permissions(), true);
    }
}
