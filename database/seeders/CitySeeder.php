<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account\City;
use App\Models\Account\Province;
use DB;
class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::connection('account')->statement('SET FOREIGN_KEY_CHECKS=0');
        DB::connection('account')->table('cities')->truncate();
        DB::connection('account')->table('provinces')->truncate();
        DB::connection('account')->statement('SET FOREIGN_KEY_CHECKS=1');

        City::create(['id_province'=> 1,'name'=>'Sleman']);
        City::create(['id_province'=> 1,'name'=>'Bantul']);
        City::create(['id_province'=> 1,'name'=>'Kulon Progo']);
        City::create(['id_province'=> 1,'name'=>'Gunung Kidul']);
        Province::create(['name'=>'Yogyakarta']);
    }
}
