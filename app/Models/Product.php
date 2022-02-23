<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'image', 'description'
    ];

    // Relations

    public function threads()
    {
        return $this->hasMany(ProductThread::class, 'product_id', 'id');
    }
}
