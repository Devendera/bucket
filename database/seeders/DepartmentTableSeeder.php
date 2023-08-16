<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//Start 11 April 2023
class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('department')->insert([
            'name' => 'IT',
        ]);
        \DB::table('department')->insert([
            'name' => 'Finance',
        ]);
    }
}
