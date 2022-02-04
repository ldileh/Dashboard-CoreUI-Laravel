<?php

namespace Database\Seeders;

use App\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create user admin
        User::create([
        	'name' => 'Admin',
        	'email' => 'admin@mail.com',
        	'password' => Hash::make('master'),
        	'user_role_id' => config('constants.USER.ROLE.ADMIN'),
        ])
        ->profile()->save(new Profile([
        	'avatar' => null,
        ]));

        // create user user
        User::create([
        	'name' => 'Dosen',
        	'email' => 'dosen@mail.com',
        	'password' => Hash::make('master'),
        	'user_role_id' => config('constants.USER.ROLE.DOSEN'),
        ])
        ->profile()->save(new Profile([
        	'avatar' => null,
        ]));

        User::create([
        	'name' => 'Mahasiswa',
        	'email' => 'mahasiswa@mail.com',
        	'password' => Hash::make('master'),
        	'user_role_id' => config('constants.USER.ROLE.MAHASISWA'),
        ])
        ->profile()->save(new Profile([
        	'avatar' => null,
        ]));
    }
}
