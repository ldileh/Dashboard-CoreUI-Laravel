<?php

namespace App;

use App\Models\Profile;
use App\Models\UserRole;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    ///////////////
    // Relations //
    ///////////////
    
    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id', 'id');
    }

    public function userRole()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }

    ////////////
    // Others //
    ////////////
    
    public function hasRole($roles)
    {
        return in_array($this->user_role_id, $roles);
    }

    public function isAdmin()
    {
        return $this->hasRole([ config('constants.USER.ROLE.ADMIN') ]);
    }

    public function isUser()
    {
        return $this->hasRole([ config('constants.USER.ROLE.USER') ]);
    }

    public static function userExceptAdmin()
    {
        return User::where('user_role_id', '!=', config('constants.USER.ROLE.ADMIN'));
    }
}
