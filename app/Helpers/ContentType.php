<?php
namespace App\Helpers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Folder;
use Illuminate\Support\Facades\Auth;
use App\FileMetaData;
use App\Unit;
use Zipper;
use App\Trash;

class ContentType {

    // Cek konten apakah folder atau file
    public static function checkType($path)
    {
        if (is_dir(storage_path('app/'.$path))) {
            return 'folder';
        }else {
            return 'file';
        }
    }

    // Hitung jumlah folder dalam direktori
    public static function countFolder($path)
    {
        if (Auth::user()->isAdmin || Auth::user()->unit->isDireksi) {
            return count(Storage::directories($path));
        } else {
            $privateFolder = Folder::where(['isPrivate' => 1, 'status' => 1])->where('id_unit', '!=', Auth::user()->id_unit)->pluck('path')->toArray();
            return count(array_diff(Storage::directories($path), $privateFolder));
        }
    }

    // Hitung jumlah file dalam direktori
    public static function countFile($path)
    {
        if (Auth::user()->isAdmin || Auth::user()->unit->isDireksi) {
            return count(Storage::files($path));
        } else {
            $privateFile = FileMetaData::where(['isPrivate' => 1, 'status' => 1])->where('id_unit', '!=', Auth::user()->id_unit)->pluck('path')->toArray();
            return count(array_diff(Storage::files($path), $privateFile));
        }
    }

    //
    public static function getContentByPath($path)
    {
        $exploded = explode('/', $path);

        return Str::after($path, $exploded[0]);
    }

    // Menampilkan nama file/folder berdasarkan path
    public static function contentName($path)
    {
        $exploded = explode('/', $path);
        $num = count($exploded);
        $i = 0;
        foreach ($exploded as $e) {
            if (++$i === $num) {
                return $e;
            }
        }
    }

    public static function relativePath($path)
    {
        $exploded = explode('/', $path);
        $rel = '';
        for ($i=0; $i < count($exploded) ; $i++) { 
            if ($i != 0) {
                $rel = $rel.' / '.$exploded[$i];
            }
        }

        return $rel;
    }

    // Mencari parent path dari folder atau file
    public static function parentPath($currentPath)
    {
        $exploded = explode('/', $currentPath);
        $num = count($exploded);
        $i = 0;
        $last = '';
        foreach ($exploded as $e) {
            if (++$i === $num) {
                $last = '/'.$e;
            }
        }

        return Str::before($currentPath, $last);
    }

    // Path file/folder untuk breadcrumb
    public static function breadcrumbPath($currentPath, $name)
    {
        return Str::before($currentPath, $name).$name;
    }

    // Menampilkan ekstensi dari sebuah file
    public static function getExtension($path)
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }

    // Menampilkan nama dari sebuah file
    public static function nameOnly($path)
    {
        return pathinfo($path, PATHINFO_FILENAME);
    }

    // Menampilkan tanggal dan waktu dari 
    public static function modified($path)
    {
        return Carbon::createFromTimestamp(Storage::lastModified($path))->toDateTimeString();
    }

    // Cek apakah path yang diakses merupakan root path milik unit yang login
    public static function rootUnit($currentPath)
    {
        if (Auth::user()->isAdmin) {
            return true;
        }

        $root = Folder::where(['id_unit' => Auth::user()->id_unit, 'root' => 1, 'status' => 1])->value('path');
        return Str::contains($currentPath, $root);
    }

    // Untuk mengambil path file yang memiliki status private
    public static function private($paths)
    {
        if (Auth::user()->isAdmin || Auth::user()->unit->isDireksi) {
            return $paths;
        } else {
            $privateFolder = Folder::where(['isPrivate' => 1, 'status' => 1])->where('id_unit', '!=', Auth::user()->id_unit)->pluck('path')->toArray();
            $privateFile = FileMetaData::where(['isPrivate' => 1, 'status' => 1])->where('id_unit', '!=', Auth::user()->id_unit)->pluck('path')->toArray();

            $private = array_merge($privateFolder, $privateFile);
            return array_diff($paths, $private);
        }
    }

    // Konversi tanggal dan waktu dari UNIX timestamp menjadi DateTimeString
    public static function localDateTimeFormat($date)
    {
        return Carbon::parse($date)->toDateTimeString();
    }

    // Cek status file/folder private atau shared
    public static function contentStatus($path, $data)
    {
        foreach ($data as $d) {
            if ($path == $d->path) {
                return $d->isPrivate == 1 ? 'Private' : 'Shared';
            }
        }
    }

    // Cek unit pemilik file/folder dari sebuah path
    public static function whoHasThisPath($path)
    {
        if (ContentType::checkType($path) == 'folder') {
            return Folder::where(['path' => $path, 'status' => 1])->value('id_unit');
        } else {
            return FileMetaData::where(['path' => $path, 'status' => 1])->value('id_unit');
        }
    }

    // Cek apakah action button dapat di render atau tidak.
    // Action button dapat di render apabila path yang diakses sesuai dengan path yang dimiliki oleh user yang login
    public static function renderActionButton($path)
    {
        if (Auth::user()->isAdmin) {
            return 1;
        }
        
        return ContentType::whoHasThisPath($path) == Auth::user()->id_unit ? 1 : 0;
    }

    public static function cannotAccess()
    {
        $user = Auth::user()->permission;

        if ($user->view || $user->create || $user->update || $user->delete || $user->download) {
            return false;
        } else {
            return true;
        }
    }

    public static function moveToTrash($pathToTrash)
    {
        $unitId = ContentType::whoHasThisPath($pathToTrash);
        $namaUnit = Unit::where(['id' => $unitId])->value('nama_unit');

        $nama = ContentType::nameOnly($pathToTrash);
        $zipName = $nama.'_'.now()->timestamp;
        $zipPath = storage_path('trash').'/'.$zipName.'.zip';
        $ToZip = storage_path('app/'.$pathToTrash);
        // $zipPathInStorage = '/'.'trash/'.$zipName.'.zip';
        // dd($zipPathInStorage);
                
        Zipper::make($zipPath)->add($ToZip)->close();

        Trash::create([
            'nama_unit' => $namaUnit,
            'isFile' => ContentType::checkType($pathToTrash) == 'file' ? 1 : 0,
            'nama_asli' => ContentType::contentName($pathToTrash),
            'nama_trash' => $zipName.'.zip',
            'latest_path' => $pathToTrash,
            'trash_path' => $zipPath,
            'expired_date' => Carbon::now()->addDays(30)->toDateString()
        ]);

        return true;
    }

    public static function isExpired($expdate)
    {
        $exp = Carbon::parse($expdate);
        if (Carbon::now()->greaterThanOrEqualTo($exp)) {
            return true;
        } else {
            return false;
        }
    }

}