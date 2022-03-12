<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'business_unit_id', 'content', 'url_page', 'slug'
    ];

    // Relations

    public function parent()
    {
        return $this->belongsTo(BusinessUnit::class, 'business_unit_id');
    }

    public function childs()
    {
        return $this->hasMany(BusinessUnit::class, 'business_unit_id', 'id');
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
