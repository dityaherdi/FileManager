<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'nama_unit', 'nama_folder', 'kapasitas', 'isDireksi', 'status'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function files()
    {
        return $this->hasMany(FileMetaData::class);
    }

    public function folders()
    {
        return $this->hasMany(Folder::class);
    }
}
