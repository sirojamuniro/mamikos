<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Auth\NameRoles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('auth')->statement('SET FOREIGN_KEY_CHECKS=0');
        DB::connection('auth')->table('roles')->truncate();
        DB::connection('auth')->statement('SET FOREIGN_KEY_CHECKS=1');


        $nameRoles = [
            [
                'name'=>"OWNER"
            ],
            [
                'name'=>"PREMIUM"
            ],
            [
                'name'=>"USER"
            ]
            ];
            foreach ($nameRoles as $nameRole) {
                NameRoles::create($nameRole);

    }
}
