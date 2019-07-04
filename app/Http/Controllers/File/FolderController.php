<?php

namespace App\Http\Controllers\File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Folder;
use App\Helpers\ContentType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Log\FolderAction;
use App\Helpers\Log\FileAction;
use App\FileMetaData;
use App\Unit;
use Zipper;
use App\Trash;
use Carbon\Carbon;

class FolderController extends Controller
{
    // Membuat folder baru
    public function createFolder(Request $request)
    {
        $currentPath = $request->current_path;
        
        if(is_null($currentPath)) {
            $folderPath = storage_path('app/public/'.$request->nama_folder);

            if (!is_dir($folderPath)) {
                Storage::makeDirectory('public/'.$request->nama_folder);
                $folder = Folder::create([
                    'id_unit' => Auth::user()->id_unit,
                    'nama_folder' => $request->nama_folder,
                    'path' => $currentPath.'/'.$request->nama_folder,
                    'isPrivate' => $request->isFolderPrivate
                ]);

                FolderAction::created($folder);
                
                toastr()->success('Folder baru telah dibuat!', 'Sukses');
                return redirect()->back();
            }

            toastr()->error('Gagal membuat folder, nama folder sudah digunakan!', 'Error');
            return redirect()->back();
        } else {
            $folderPath = storage_path('app/'.$currentPath.'/'.$request->nama_folder);
            
            if (!is_dir($folderPath)) {
                Storage::makeDirectory($currentPath.'/'.$request->nama_folder);
                $folder = Folder::create([
                    'id_unit' => Auth::user()->id_unit,
                    'nama_folder' => $request->nama_folder,
                    'path' => $currentPath.'/'.$request->nama_folder,
                    'isPrivate' => $request->isFolderPrivate
                ]);

                FolderAction::created($folder);
                toastr()->success('Folder baru telah dibuat!', 'Sukses');
                return redirect()->back();
            }

            toastr()->error('Gagal membuat folder, nama folder sudah digunakan!', 'Error');
            return redirect()->back();
        }

    }

    // Navigasi untuk masuk ke dalam sebuah direktori dan melihat konten di dalamnya
    public function next(Request $request)
    {
        $currentPath = $request->current_path;

        $directories = Storage::directories($currentPath);
        $files = Storage::files($currentPath);
        $paths = array_merge($directories, $files);

        return view('file.index', compact('paths', 'currentPath'));
    }

    // Navigasi untuk kembali ke direktori sebelumnya (menuju parent direktori)
    public function back(Request $request)
    {
        $currentPath = $request->parent;
        
        $directories = Storage::directories($currentPath);
        $files = Storage::files($currentPath);
        $paths = array_merge($directories, $files);

        return view('file.index', compact('paths', 'currentPath')); 
    }

    // Untuk memperbarui nama folder
    // Apabila nama folder diperbarui maka konten di dalamnya akan ikut terdampak
    // Diperlukan pembaruan nama Path untuk setiap konten di dalam folder yang namanya telah diperbarui
    public function rename(Request $request)
    {
        $currentPath = $request->current_path;

        $base = Str::before($request->current_path, $request->current_name);
        $toUpdate = $base.$request->nama_folder;

        if ($currentPath != $toUpdate) {
            $oldName = ContentType::contentName($currentPath);
            $filesInsideThisFolder = FileMetaData::where('path', 'like', '%'.$request->current_path.'%')->where(['status' => 1])->get();
            $foldersInsideThisFolder = Folder::where('path', 'like', '%'.$request->current_path.'%')->where(['status' => 1])->get();

            Storage::move($currentPath, $toUpdate);
            $folder = Folder::where(['path' => $currentPath, 'status' => 1])->first();
            $folder->update(['nama_folder' => $request->nama_folder, 'path' => $toUpdate]);

            foreach ($filesInsideThisFolder as $file) {
                $childFile = Str::after($file->path, $request->current_path);
                $updatedFilePath = $toUpdate.$childFile;
                $file->update(['path' => $updatedFilePath]);
            }

            foreach ($foldersInsideThisFolder as $folder) {
                $childFolder = Str::after($folder->path, $request->current_path);
                $updatedFolderPath = $toUpdate.$childFolder;
                $folder->update(['path' => $updatedFolderPath]);
            }
            
            $currentPath = $toUpdate;
            
            FolderAction::renamed($folder, $oldName);
            toastr()->success('Folder telah diperbarui', 'Sukses');
            return redirect()->back()->with(compact('currentPath'));
        }

        toastr()->info('Tidak ada pembaruan dilakukan', 'Info');
        return redirect()->back()->with(compact('currentPath'));

    }

    // Menghapus folder
    // Folder yang dihapus akan menghapus seluruh file/folder yang terdapat pada folder tersebut
    public function deleteFolder(Request $request)
    {
        $currentPath = $request->current_path;

        if (Storage::exists($request->current_path)) {
            $toTrash = ContentType::moveToTrash($request->current_path);

            if ($toTrash) {
                $fileInsideThisFolder = FileMetaData::where('path', 'LIKE', '%'.$request->current_path.'%')->where(['status' => 1])->get();
                $folderInsideThisFolder = Folder::where('path', 'LIKE', '%'.$request->current_path.'%')->where(['status' => 1])->get();
    
                foreach ($fileInsideThisFolder as $fileToDelete) {
                    $fileToDelete->update(['status' => 0]);
                    FileAction::deleted($fileToDelete);
                }
                foreach ($folderInsideThisFolder as $folderToDelete) {
                    $folderToDelete->update(['status' => 0]);
                    FolderAction::deleted($folderToDelete);
                }
    
                Storage::deleteDirectory($request->current_path);
                $currentPath = Str::before($request->current_path, $request->folder);
                
                toastr()->success('Folder telah dihapus', 'Sukses');
                return redirect()->back()->with(compact('currentPath'));
            }
        } else {
            toastr()->warning('Tidak ada folder yang dihapus', 'Peringatan');
            return redirect()->back()->with(compact('currentPath'));
        }

    }

}
