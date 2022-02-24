<?php

namespace App\Models;

use App\Models\VideoThread;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'banner', 'video_url', 'description'
    ];

    // Relations

    public function threads()
    {
        return $this->hasMany(VideoThread::class, 'video_id', 'id');
    }
}
