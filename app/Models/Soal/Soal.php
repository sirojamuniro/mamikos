<?php

namespace App\Models\Soal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $connection = 'soal';

    protected $table = 'soal';

    protected $fillable = ['category', 'description','thumbnail','tag','price'];

    protected $hidden = ['created_at', 'updated_at'];

}
