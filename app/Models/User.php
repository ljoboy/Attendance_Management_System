<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method static findOrFail(int $int)
 * @method static where(string $string, string $string1, int $int)
 * @method static factory(int $int)
 */
class User extends Authenticatable
{
    use Notifiable, HasFactory;


    public function getRouteKeyName()
    {
        return 'name';
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_users', 'user_id', 'role_id');
    }

    public function hasAnyRole($roles)
    {
        if (Is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }

        return false;
    }

    public static function hasRole($role)
    {
        if (auth()->user()->roles()->first()->slug === $role) {
            return true;
        }
        return false;
    }


    protected $fillable = [
        'name', 'email', 'password', 'pin_code',
    ];


    protected $hidden = [
        'pin_code','password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
