<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\NameRoles;

class Roles extends Model
{
    use HasFactory;

    protected $connection = 'auth';

    protected $table = 'has_roles';

    protected $fillable = ['role_id', 'user_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function has_roles()
    {
    	return $this->belongsTo(NameRoles::class, 'role_id', 'id');
    }
}

