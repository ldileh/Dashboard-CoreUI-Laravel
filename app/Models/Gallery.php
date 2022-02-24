<?php

namespace App\Models;

use App\Models\GalleryDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug'
    ];

    // Relations

    public function images()
    {
        return $this->hasMany(GalleryDetail::class, 'gallery_id', 'id');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
