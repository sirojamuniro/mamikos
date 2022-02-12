<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auth\User;
use App\Models\Account\User as UserAccount;
use App\Models\Auth\Roles;
use App\Models\Account\Credit;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    DB::beginTransaction();
    try {
        $user = User::create([
            'email'=> 'munirosiroja@gmail.com',
            'password'=> bcrypt('sirojamuniro'),
        ]);

        Roles::create(['user_id' => $user->id, 'role_id' => 1]);

       $account= UserAccount::create([
            'auth_id'=>$user->id,
            'fullname'=> 'Siroja Muniro',
            'username'=> 'sirojamuniro',
            'email'=> $user->email,
            'gender'=>'Male',
            'dob'=>'1997-04-09',
            'introduction'=>'saya sirojamuniro',
            'self_description'=>'saya sirojamuniro',
            'id_city'=>1
        ]);
        $account->credit()->create(['user_id'=>$account->id,'credit_score'=>0]);

        DB::commit();

    }   catch (\Exception $e) {
        DB::rollback();

        return $e->getMessage();

    }
}

}
