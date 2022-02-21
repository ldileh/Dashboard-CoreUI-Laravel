<?php

namespace Database\Seeds;

use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::insert([
        	[ 'id' => 1, 'name' => 'Admin' ],
        	[ 'id' => 2, 'name' => 'Management' ],
        ]);
    }
}
