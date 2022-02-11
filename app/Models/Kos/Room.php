<?php

namespace App\Models\Kos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'kos';

    protected $table = 'room';

    protected $fillable=[
        'is_active',
    	'token',
    ];

    protected $hidden = ['updated_at', 'deleted_at'];

}
