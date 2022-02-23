<?php

namespace App\Models;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_id', 'image', 'size'
    ];

    // Relations

    public function gallery()
    {
        return $this->hasOne(Gallery::class, 'gallery_id', 'id');
    }
}
