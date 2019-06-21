<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Folder;
use App\FileMetaData;

class UserLog extends Model
{
    protected $fillable = [
        'id_user', 'id_file', 'id_folder', 'path', 'aksi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class, 'id_folder');
    }

    public function file()
    {
        return $this->belongsTo(FileMetaData::class, 'id_file');
    }

}
