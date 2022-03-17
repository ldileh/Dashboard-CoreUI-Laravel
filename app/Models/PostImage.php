<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'size'
    ];

    public function getImageUrl()
    {
        return asset('storage/images/others/' . $this->image);
    }
}
