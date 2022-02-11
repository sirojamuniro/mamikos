<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'account';

    protected $table = 'cities';

    protected $fillable = ['id_province', 'name'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function users()
    {
        return $this->hasMany(User::class, 'id_city', 'id');
    }

    public function province()
    {
    	return $this->belongsTo(Province::class, 'id_province', 'id');
    }
}
