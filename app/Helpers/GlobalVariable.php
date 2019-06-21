<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Storage;
use App\Unit;
use App\Folder;
use App\FileMetaData;
use Illuminate\Support\Facades\Auth;

class GlobalVariable {

    // Mengambil semua data folder yang aktif
    public static function foldersData()
    {
        return Folder::where('status', 1)->get();
    }

    // Mengambil semua data file yang aktif
    public static function filesData()
    {
        return FileMetaData::where('status', 1)->get();
    }

}