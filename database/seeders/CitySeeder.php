<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account\City;
use App\Models\Account\Province;
class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create(['id_province'=> 1,'name'=>'Sleman']);
        City::create(['id_province'=> 1,'name'=>'Bantul']);
        City::create(['id_province'=> 1,'name'=>'Kulon Progo']);
        City::create(['id_province'=> 1,'name'=>'Gunung Kidul']);
        Province::create(['name'=>'Yogyakarta']);
    }
}
