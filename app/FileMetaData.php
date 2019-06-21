<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileMetaData extends Model
{
    protected $fillable = [
        'id_unit', 'nama_file', 'size', 'extensi', 'path', 'isPrivate', 'isParentPrivate','status', 'keterangan'
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit');
    }
}
