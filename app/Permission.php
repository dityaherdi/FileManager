<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'id_user', 'view', 'create', 'update', 'delete'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
