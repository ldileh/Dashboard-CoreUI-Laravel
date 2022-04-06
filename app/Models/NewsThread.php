<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsThread extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id', 'description'
    ];

    public function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }
}
