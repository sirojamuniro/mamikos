<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NameRoles extends Model
{
    use HasFactory;


    protected $connection = 'auth';

    protected $table = 'roles';

    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'updated_at'];
}
