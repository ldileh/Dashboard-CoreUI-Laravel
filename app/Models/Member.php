<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'birth_place', 'birth_date', 'gender', 'nik', 'profession', 'address', 'phone_number', 'email', 'file_ktp', 'file_passport_photo'
    ];
}