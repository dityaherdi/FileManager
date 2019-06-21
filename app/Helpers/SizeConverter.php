<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Storage;
use App\Unit;
use App\Folder;
use Auth;

class SizeConverter {

    // Konversi dari Gigabyte ke Byte
    public static function fromGigaToBytes($value)
    {
        return $value * pow(1024, 3);
    }

    // Konversi dari Byte ke Gigabyte
    public static function fromBytesToGiga($value)
    {
        return $value / pow(1024, 3);
    }

    // Mengambil size dari sebuah file
    public static function fileSize($path)
    {
        return SizeConverter::formatSizeUnits(Storage::size($path));
    }

    // Mengambil total size dari sebuah folder
    public static function folderSize($path)
    {
        $size = 0;
        foreach (Storage::allFiles($path) as $file) {
            $size += Storage::size($file);
        }

        return SizeConverter::formatSizeUnits($size);
    }

    // Mengambil kapasitas tersedia dari kapasitas maksimum yang dimiliki oleh unit
    public static function diskSpace()
    {
        $root = Folder::where(['id_unit' => Auth::user()->id_unit, 'root' => 1])->value('path');
        $capacity = Unit::where(['id' => Auth::user()->id_unit])->value('kapasitas');

        return 'Kapasitas : '.SizeConverter::folderSize($root).' digunakan dari '.SizeConverter::formatSizeUnits($capacity).' tersedia';
    }

    // Mengambil kapasitas tersedia dari kapasitas maksimum yang dimiliki oleh unit untuk administrator
    public static function diskSpaceForAdmin($currentPath)
    {
        $unit = ContentType::whoHasThisPath($currentPath);

        $root = Folder::where(['id_unit' => $unit, 'root' => 1])->value('path');
        $capacity = Unit::where(['id' => $unit])->value('kapasitas');

        return 'Kapasitas : '.SizeConverter::folderSize($root).' digunakan dari '.SizeConverter::formatSizeUnits($capacity).' tersedia';
    }

    // Mengambil jumlah kapasitas yang sudah digunakan oleh unit
    public static function usage()
    {
        $root = Folder::where(['id_unit' => Auth::user()->id_unit, 'root' => 1])->value('path');
        $usage = 0;
        foreach (Storage::allFiles($root) as $file) {
            $usage += Storage::size($file);
        }

        return $usage;
    }

    // Mengambil kapasitas yang dimiliki oleh unit
    public static function capacity()
    {
        return Unit::where(['id' => Auth::user()->id_unit])->value('kapasitas');
    }

    // Memeriksa ketersediaan kapasitas apakah masih memungkinkan untuk meng-upload file atau tidak
    public static function capacityIsNotFull($size)
    {
        $usage = SizeConverter::usage();
        $capacity = SizeConverter::capacity();
        $estimatedSize = $usage + $size;

        return $estimatedSize < $capacity ? true : false;
    }

    // Menentukan presentase kapasitas tersedia (digunakan untuk tampilan bar)
    public static function capacityWidth()
    {
        $usage = SizeConverter::usage();
        $capacity = SizeConverter::capacity();
        
        if ($usage != 0) {
            return ($usage / $capacity) * 100;
        } else {
            return 0;
        }
    }

    // Menentukan presentase kapasitas tersedia (digunakan untuk tampilan bar untuk administrator)
    public static function capacityWidthForAdmin($currentPath)
    {
        if ($currentPath != 'public') {
            $unit = ContentType::whoHasThisPath($currentPath);

            $root = Folder::where(['id_unit' => $unit, 'root' => 1])->value('path');
            $usage = 0;
            foreach (Storage::allFiles($root) as $file) {
                $usage += Storage::size($file);
            }

            $capacity = Unit::where(['id' => $unit])->value('kapasitas');

            if ($usage != 0) {
                return ($usage / $capacity) * 100;
            } else {
                return 0;
            }
        }
    }

    // Menentukan warna yang digunakan sesuai dengan jumlah kapasitas yang sudah digunakan (digunakan untuk tampilan bar)
    public static function capacityColor($width)
    {
        if ($width <= 40) {
            return 'bg-success';
        } elseif ($width > 40 && $width <= 65){
            return 'bg-primary';
        } elseif ($width > 65 && $width <= 84) {
            return 'bg-warning';
        } else {
            return 'bg-danger';
        }
        
    }

    // Memberikan format penulisan untuk size (GB, MB, KB, bytes, byte)
    public static function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

}