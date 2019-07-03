<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trash extends Model
{
    protected $fillable = [
        'nama_unit', 'isFile', 'nama_asli', 'nama_trash', 'latest_path', 'trash_path', 'expired_date', 'isTrashRemovedPermanently'
    ];
}
