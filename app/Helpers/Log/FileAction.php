<?php
namespace App\Helpers\Log;
use App\UserLog;
use Illuminate\Support\Facades\Auth;

class FileAction {
    
    public static function created($file)
    {
        UserLog::create([
            'id_user' => Auth::user()->id,
            'id_file' => $file->id,
            'path' => $file->path,
            'aksi' => Auth::user()->nama_user.' meng-upload file '.$file->nama_file
        ]);
    }

    public static function renamed($file, $oldName)
    {
        UserLog::create([
            'id_user' => Auth::user()->id,
            'id_file' => $file->id,
            'path' => $file->path,
            'aksi' => Auth::user()->nama_user.' mengubah nama file '.$oldName.' menjadi '.$file->nama_file
        ]);
    }

    public static function deleted($file)
    {
        UserLog::create([
            'id_user' => Auth::user()->id,
            'id_file' => $file->id,
            'path' => $file->path,
            'aksi' => Auth::user()->nama_user.' menghapus file '.$file->nama_file
        ]);
    }
    
    public static function downloaded($file)
    {
        UserLog::create([
            'id_user' => Auth::user()->id,
            'id_file' => $file->id,
            'path' => $file->path,
            'aksi' => Auth::user()->nama_user.' men-download file '.$file->nama_file
        ]);
    }

}