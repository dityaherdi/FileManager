<?php
namespace App\Helpers\Log;
use App\UserLog;
use Illuminate\Support\Facades\Auth;

class FolderAction {
    
    public static function created($folder)
    {
        UserLog::create([
            'id_user' => Auth::user()->id,
            'id_folder' => $folder->id,
            'path' => $folder->path,
            'aksi' => Auth::user()->nama_user.' membuat folder '.$folder->nama_folder
        ]);
    }

    public static function renamed($folder, $oldName)
    {
        UserLog::create([
            'id_user' => Auth::user()->id,
            'id_folder' => $folder->id,
            'path' => $folder->path,
            'aksi' => Auth::user()->nama_user.' mengubah nama folder '.$oldName.' menjadi '.$folder->nama_folder
        ]);
    }

    public static function deleted($folder)
    {
        UserLog::create([
            'id_user' => Auth::user()->id,
            'id_folder' => $folder->id,
            'path' => $folder->path,
            'aksi' => Auth::user()->nama_user.' menghapus folder '.$folder->nama_folder
        ]);
    }

}