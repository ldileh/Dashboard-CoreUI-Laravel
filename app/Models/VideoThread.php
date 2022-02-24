<?php

namespace App\Models;

use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoThread extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_id', 'description'
    ];

    // Relations

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
