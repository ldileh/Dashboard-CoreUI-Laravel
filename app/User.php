<?php

namespace App;

use App\Models\Profile;
use App\Models\UserRole;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'user_role_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Relations

    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function userRole()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }

    // Others

    public function hasRole($roles)
    {
        return in_array($this->user_role_id, $roles);
    }

    public function isAdmin()
    {
        return $this->hasRole([ config('constants.USER.ROLE.ADMIN') ]);
    }

    public function isManagement()
    {
        return $this->hasRole([ config('constants.USER.ROLE.MANAGEMENT') ]);
    }

    public function isUserPanel()
    {
        return $this->hasRole([config('constants.USER.ROLE.ADMIN'), config('constants.USER.ROLE.MANAGEMENT')]);
    }

    public static function userExceptAdmin()
    {
        return User::where('user_role_id', '!=', config('constants.USER.ROLE.ADMIN'));
    }
}
