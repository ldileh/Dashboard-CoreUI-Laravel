<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_status_id', 'name', 'birth_place', 'birth_date', 'gender', 'nik', 'profession', 'komunitas_adat', 'address', 'phone_number', 'email', 'file_ktp', 'file_passport_photo'
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

    public static function membersApproved()
    {
        return Member::where('member_status_id', config('constants.MEMBER.STATUS.APPROVE'))->get();
    }

    public static function membersRegister()
    {
        return Member::where('member_status_id', config('constants.MEMBER.STATUS.REGISTER'))->get();
    }

    public static function membersAll()
    {
        return Member::get();
    }
}
