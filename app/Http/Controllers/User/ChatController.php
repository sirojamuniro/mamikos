<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kos\ChatRoom;
use App\Models\Account\Credit;
use App\Models\Account\User;
use Throwable;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

        $this->middleware('admin')->only(['inputKos','updateKos','deleteKos','myKos']);

    }

    public function sendMessage(Request $request)
    {
        $idRoles = auth()->user()->roles->role_id;

        $idUser = auth()->user()->profile->id;

        $users = Credit::where('user_id', $idUser)->first();

        $creditScore = (int) $users->credit_score;

        $message = $request->input("message");

        $idReceiver = $request->input('id_receiver');

        if($idReceiver == $idUser){
            return $this->handleResponse(404, "your cannot send message to yourself" );
        }
            if($idRoles == 2 || $idRoles == 3){
                if($creditScore <= 0 ){
                   return $this->handleResponse(404, "your credit must 0 waiting to recharge again" );
                }


                $minus = (int) $creditScore - 5;

                Credit::where('user_id', $idUser)->update(['credit_score'=>$minus]);
             }

             $result = ChatRoom::create([
                 'sender_id' =>  $idUser,
                 'receiver_id' => $idReceiver,
                 'message' => $message,
             ]);

             return $this->handleResponse(200, 'success',$result);
    }

    public function getMessage($id)
    {
    	$sender = User::where('id', $id)->first();

    	$idReceiver = auth()->user()->profile->id;

    	$result = [];

    	if (!is_null($sender)) {
    		$idSender = $sender->id;

	    	$result = ChatRoom::with(['sender', 'receiver'])
	    				->where(function($q) use ($idSender, $idReceiver) {
				    		$q->where('sender_id', $idSender)
				    			->where('receiver_id', $idReceiver);
				    	})
	    				->orWhere(function($q) use ($idSender, $idReceiver) {
	    					$q->where('receiver_id', $idSender)
	    						->where('sender_id', $idReceiver);
	    				})
	    				->orderBy('created_at')
	    				->get();
        }

    	return $this->handleResponse(200, 'success', $result);
    }

}
