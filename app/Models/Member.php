<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_status_id', 'name', 'birth_place', 'birth_date', 'gender', 'nik', 'profession', 'address', 'phone_number', 'email', 'file_ktp', 'file_passport_photo'
    ];

    // Relations

    public function memberStatus()
    {
        return $this->belongsTo(MemberStatus::class, 'member_status_id');
    }

    // Others

    public function hasStatus($status)
    {
        return in_array($this->member_status_id, $status);
    }

    public function isApprove()
    {
        return $this->hasRole([ config('constants.MEMBER.STATUS.APPROVE') ]);
    }
}
