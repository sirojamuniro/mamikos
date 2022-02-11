<?php

namespace App\Models\Kos;

use App\Models\Account\City;
use App\Models\Account\Province;
use App\Models\Account\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boarding extends Model
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

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
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
