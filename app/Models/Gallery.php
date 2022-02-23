<?php

namespace App\Models;

use App\Models\GalleryDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // Relations

    public function images()
    {
        return $this->hasMany(GalleryDetail::class, 'gallery_id', 'id');
    }
}
