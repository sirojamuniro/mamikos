<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auth\User;
use App\Models\Account\User as UserAccount;
use App\Models\Auth\Roles;
use App\Models\Auth\NameRoles;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::create(['user_id' => 1, 'role_id' => 1]);
        NameRoles::create(['name' => 'ADMIN']);
        NameRoles::create(['name' => 'TUTOR']);
        $user = User::create([
            'email'=> 'munirosiroja@gmail.com',
            'password'=> bcrypt('sirojamuniro'),
        ]);
        UserAccount::create([
            'fullname'=> 'Siroja Muniro',
            'username'=> 'sirojamuniro',
            'email'=> 'munirosiroja@gmail.com',
            'gender'=>'Male',
            'dob'=>'1997-04-09',
            'introduction'=>'saya sirojamuniro',
            'self_description'=>'saya sirojamuniro',
            'id_city'=>1

        ]);

    }
}
