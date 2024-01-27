<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('receptionists')->insert([
            'user_id' => 1,
            'first_name' => 'Keshav',
            'last_name' => 'Arunesar',
            'dob' => '2001-12-20',
            'mobile_number' => '0761122762',
            'nic' => 200135502776,
            'gender' => 'Male',
            'address_lane_1' => '124/2, Nursing Home Road',
            'city' => 'Hatton'
        ]);
    }
}
