<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//Start 11 April 2023
class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('employee')->insert([
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'phone' => '87878787878',
            'remarks' => 'Test Remarks',
            'department_id' => '1',

        ]);
    }
}
