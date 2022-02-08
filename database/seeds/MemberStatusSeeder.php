<?php

namespace Database\Seeders;

use App\Models\MemberStatus;
use Illuminate\Database\Seeder;

class MemberStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MemberStatus::insert([
        	[ 'id' => 1, 'name' => 'Register' ],
        	[ 'id' => 2, 'name' => 'Approve' ],
        ]);
    }
}
