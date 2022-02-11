<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use App\Models\Auth\User as UserAuth;
use App\Models\Auth\Roles;

class User extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $connection = 'account';

    protected $table = 'users';

    protected $fillable=[
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

    protected $hidden = ['verification_code', 'forgot_password_token', 'created_at', 'updated_at', 'deleted_at'];

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
        return $this->hasOne(UserAuth::class, 'email', 'email');
    }

    public function roles()
    {
        return $this->hasOne(Roles::class, 'user_id', 'id');
    }
}


