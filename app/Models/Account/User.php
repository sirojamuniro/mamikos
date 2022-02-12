<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use App\Models\Auth\User as UserAuth;
use App\Models\Auth\Roles;
use App\Models\Kos\Boarding;

class User extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $connection = 'account';

    protected $table = 'users';

    protected $fillable=[
        'auth_id',
        'fullname',
    	'email',
    	'email_verified_at',
        'verification_code',
        'is_verified',
    	'username',
    	'password',
    	'gender',
    	'dob',
    	'introduction',
    	'self_description',
    	'id_city',
    ];

    protected $hidden = ['verification_code', 'forgot_password_token', 'updated_at', 'deleted_at'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'id_city', 'id');
    }

    public function auth_user()
    {
        return $this->belongsTo(UserAuth::class, 'auth_id', 'id');
    }

    public function credit()
    {
        return $this->hasOne(Credit::class, 'user_id', 'id');
    }

    public function boarding()
    {
        return $this->hasMany(Boarding::class, 'user_id', 'id');
    }
}


