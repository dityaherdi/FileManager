<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FileMetaData;
use App\Folder;
use App\Helpers\ContentType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UtilitiesController extends Controller
{
    // Searching...
    public function search(Request $request)
    {
        $key = $request->keyword;

        $fileResult = FileMetaData::with('unit')
                        ->where('nama_file', 'LIKE', "%$key%")
                        ->where(['status'=> 1, 'isPrivate' => 0, 'isParentPrivate' => 0])
                        ->orderBy('nama_file', 'ASC')->get();

        $folderResult = Folder::with('unit')
                            ->where('nama_folder', 'LIKE', "%$key%")
                            ->where(['status'=> 1, 'isPrivate' => 0, 'isParentPrivate' => 0])
                            ->orderBy('nama_folder', 'ASC')->get();

        if ($fileResult->isNotEmpty() || $folderResult->isNotEmpty()) {
            return view('home', compact('key', 'fileResult', 'folderResult'));
        } else {
            $oldKey = $key;
            $key = '';
            return view('home', compact('key', 'oldKey', 'fileResult', 'folderResult'));
        }

    }

    // Menuju direktori dari hasil pencarian menuju lokasi asli direktori tersebut
    public function toDestination(Request $request)
    {
        $path = $request->path;

        if (ContentType::checkType($path) == 'folder') {
            $destination = $path;
        } else {
            $destination = Str::before($path, '/'.ContentType::contentName($path));
        }

        $currentPath = $destination;
        $direcroties = Storage::directories($destination);
        $files = Storage::files($destination);
        $paths = array_merge($direcroties, $files);

        return view('file.index', compact('paths', 'currentPath'));
    }

    public function detail(Request $request)
    {
        $fileDetail = FileMetaData::where('path', $request->current_path)->first();
        return view('file.detail', compact('fileDetail'));
    }

    public function userManual()
    {
        return view('manual.user_manual');
    }
}
