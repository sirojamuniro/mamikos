<?php

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Credit extends Model
{
    use HasFactory, SoftDeletes;

    protected $connection = 'account';

    protected $table = 'credit';

    protected $fillable=[
        'user_id',
    	'credit_score',
    ];

    protected $hidden = ['updated_at', 'deleted_at'];

    public function user()
    {
    	return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
