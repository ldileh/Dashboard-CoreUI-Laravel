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
        	'name' => 'Management',
        	'email' => 'management@mail.com',
        	'password' => Hash::make('master'),
        	'user_role_id' => config('constants.USER.ROLE.MANAGEMENT'),
        ])
        ->profile()->save(new Profile([
        	'avatar' => null,
        ]));
    }
}
