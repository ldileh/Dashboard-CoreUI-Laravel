<?php

namespace Database\Seeders;

use App\Models\CompanyProfileType;
use Illuminate\Database\Seeder;

class CompanyProfileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompanyProfileType::insert([
        	[ 'id' => 1, 'name' => 'Peraturan' ],
        	[ 'id' => 2, 'name' => 'Laporan' ],
        ]);
    }
}
