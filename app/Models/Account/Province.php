<?php

namespace App\Models\Account;

use App\Models\Kos\Boarding;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'account';

    protected $table = 'provinces';

    protected $fillable = ['name'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function cities()
    {
    	return $this->hasMany(City::class, 'id_province', 'id');
    }

    public function boarding()
    {
    	return $this->hasMany(Boarding::class, 'province_id', 'id');
    }
}
