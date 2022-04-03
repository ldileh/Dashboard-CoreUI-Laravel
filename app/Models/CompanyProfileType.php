<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfileType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function companyProfile()
    {
        return $this->hasOne(CompanyProfile::class, 'company_profile_type_id', 'id');
    }
}
