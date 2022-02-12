<?php

namespace App\Models\Kos;

use App\Models\Account\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatRoom extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'kos';

    protected $table = 'chat_room';

    protected $fillable=[
        'sender_id',
    	'receiver_id',
        'message',
    ];

    protected $hidden = ['updated_at', 'deleted_at'];

    public function city()
    {
    	return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function province()
    {
    	return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function sender()
    {
    	return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function receiver()
    {
    	return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}
