<?php

namespace App\Models\Kos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatRoom extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'kos';

    protected $table = 'boarding_house';

    protected $fillable=[
        'name',
    	'description',
        'price',
        'image',
        'user_id',
        'province_id',
        'city_id',
    ];

    protected $hidden = ['updated_at', 'deleted_at'];

    public function room()
    {
    	return $this->belongsTo(Room::class, 'user_id', 'id');
    }

    public function city()
    {
    	return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function province()
    {
    	return $this->belongsTo(Province::class, 'province_id', 'id');
    }
}
