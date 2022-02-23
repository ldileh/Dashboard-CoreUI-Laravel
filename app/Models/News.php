<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'content', 'banner', 'user_id'
    ];

    // Relations

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
