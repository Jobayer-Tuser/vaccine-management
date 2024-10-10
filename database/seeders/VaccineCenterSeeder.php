<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VaccineCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $centerName = [
            'Udayan uccho maddhomik biddyaloy',
            'Engineering university school and College',
            'Engineering university girls school and College',
            'Nilkhet high school',
            'University laboratory school and College',
            'Viqarunnisa noon school and College',
            'Siddheswari college',
            'Siddheswari girls college',
            'Begum Rahima girls school',
            'Bangovabon govt primary',
            'Shahid sriti school',
            'Shahid nobi school',
            'Dokkhin muhosindi high school',
            'Purana palton college',
            'Wari high school',
            'Tikatuli kamrunnesa govt high school',
            'Siddheswari boys high school',
            'Habibullah Bahar college',
            'Kids tutorial',
            'Silverdal preparatory girls school',
            'Swide Bangladesh school',
            'Segunbagicha high school',
            'Dhaka bodhir govt school'
        ];

        foreach($centerName as $eachCenter) {
            DB::table("vaccination_centers")->insert([
                "name" => $eachCenter,
                "capacity" => 30,
            ]);
        }
    }
}
