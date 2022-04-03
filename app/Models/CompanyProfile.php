<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_profile_type_id', 'content'
    ];

    // Relations

    public function type()
    {
        return $this->belongsTo(CompanyProfileType::class, 'company_profile_type_id');
    }

    public static function getByType($typeId)
    {
        return CompanyProfile::where('company_profile_type_id', $typeId)->first();
    }
}
