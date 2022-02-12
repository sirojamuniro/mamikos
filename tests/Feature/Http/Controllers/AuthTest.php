<?php

namespace Tests\Feature\Http\Controllers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Auth\User;
use App\Models\Account\User as UserAccount;
use App\Models\Auth\Roles;
use App\Models\Account\Credit;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class AuthTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUserIsCreatedSuccessfully()
    {
        $user = User::create([
            'email'=> $this->faker->email,
            'password'=>  $this->faker->password,
        ]);

        Roles::create(['user_id' => $user->id, 'role_id' => 1]);

       $account= UserAccount::create([
            'auth_id'=>$user->id,
            'fullname'=> $this->faker->fullname,
            'username'=> $this->faker->username,
            'email'=> $user->email,
            'gender'=>'Male',
            'dob'=>'1997-04-09',
            'introduction'=>$this->faker->words(10,true),
            'self_description'=>$this->faker->words(10,true),
            'id_city'=>1
        ]);
        $account->credit()->create(['user_id'=>$account->id,'credit_score'=>0]);

        $this->json('post', "api/auth/register")
        ->assertStatus(Response::HTTP_CREATED);

    }


    // public function testGetMyUser()
    // {

    //     $this->json('post', 'api/auth/register')
    //     ->assertStatus(Response::HTTP_CREATED);

    // }
}
