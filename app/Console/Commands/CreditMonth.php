<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Account\User;
use App\Models\Account\Credit;
use App\Models\Auth\User as Auth;

class CreditMonth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'credit:month';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Credit Every Month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::with('auth_user')->get();
        foreach($users as $user){
          $idRole=  $user->auth_user->role_id;

          if($idRole == 1){ 
            $creditUser = Credit::where('user_id',$user->id)->first();
            $sum = (int) $creditUser->credit_score + 0;

          }if($idRole == 2){ 
            $creditUser = Credit::where('user_id',$user->id)->first();
            $sum = (int) $creditUser->credit_score + 40;
            
          }if($idRole == 3){ 
            $creditUser = Credit::where('user_id',$user->id)->first();
            $sum = (int) $creditUser->credit_score + 20;
            
          }
                $update= Credit::where('user_id',$user->id)->update(['credit_score'=>$sum]);
            
        }
    }
}
