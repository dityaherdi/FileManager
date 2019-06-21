<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = [
        'id_unit', 'nama_folder', 'path', 'root', 'isPrivate', 'isParentPrivate'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit');
    }
}
