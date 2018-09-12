<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
    	'avatar', 'user_id'
    ];

    // Relations
	
	public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }    
}
