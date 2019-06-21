<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $fillable = [
        'nama_jabatan'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
