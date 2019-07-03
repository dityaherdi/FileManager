<?php

namespace App\Http\Controllers\File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\FileMetaData;
use Illuminate\Support\Facades\Auth;
use App\Folder;
use App\Helpers\Log\FileAction;
use App\Helpers\ContentType;
use App\Helpers\SizeConverter;
use App\Http\Requests\FileUploadRequest;
use App\Trash;
use Zipper;
use Carbon\Carbon;
use App\Unit;

class FileController extends Controller
{
    // Mengambil path yang dapat diakses melalui menu Shared Files
    public function sharedFiles()
    {
        $currentPath = 'public';
        
        $directories = Storage::directories('public');
        $files = Storage::files('public');
        $paths = array_merge($directories, $files);

        return view('file.index', compact('paths', 'currentPath'));
    }

    // Mengambil path yang dapat diakses melalui menu Unit Files
    public function unitFiles()
    {
        $root = Folder::where(['id_unit' => Auth::user()->id_unit, 'root' => 1, 'status' => 1])->value('path');
        $currentPath = $root;

        if (Auth::user()->isAdmin) {
            $currentPath = 'public';
        }

        $directories = Storage::directories($root);
        $files = Storage::files($root);

        $paths = array_merge($directories, $files);

        return view('file.index', compact('paths', 'currentPath'));
    }

    // Upload file (fungsi ini tidak digunakan dalam production, hanya percobaan saat proses development)
    public function upload(FileUploadRequest $request)
    {
        $currentPath = $request->current_path;
        $size = $request->file_size;

        if (SizeConverter::capacityIsNotFull($size)) {
            if ($request->hasFile('file')) {
                $pathToSave = $request->current_path;
                $filename = $request->file->getClientOriginalName();
                $filesize = $request->file->getSize();
                $extension = $request->file->getClientOriginalExtension();
                $fullpath = $pathToSave.'/'.$filename;

                if (!Storage::exists($fullpath)) {
                    Storage::putFileAs($pathToSave, $request->file, $filename);
                    $file = FileMetaData::create([
                        'id_unit' => Auth::user()->id_unit,
                        'nama_file' => $filename,
                        'size' => $filesize,
                        'extensi' => $extension,
                        'isPrivate' => $request->isFilePrivate,
                        'path' => $fullpath,
                        'status' => 1,
                        'keterangan' => $request->keterangan
                    ]);

                    FileAction::created($file);

                    toastr()->success('Upload file berhasil!', 'Sukses');
                    return redirect()->back()->with(compact('currentPath'));   
                }

                toastr()->error('File yang sama sudah diupload!', 'Error');
                return redirect()->back()->with(compact('currentPath'));  
            }
        } else {
            toastr()->error('Kapasitas folder tidak mencukupi!', 'Error');
            return redirect()->back()->with(compact('currentPath'));
        }
    }

    // Mendownload file
    public function download(Request $request)
    {
        $filePathToDownload = $request->current_path;
        $file = FileMetaData::where(['path' => $filePathToDownload, 'status' => 1])->first();
        
        FileAction::downloaded($file);
        return Storage::download($filePathToDownload);
    }

    // Memperbarui nama file
    public function rename(Request $request)
    {
        $currentPath = $request->current_path;

        $base = Str::before($request->current_path, $request->current_name);
        $toUpdate = $base.$request->nama_file.$request->ext;

        if ($currentPath != $toUpdate) {
            $oldName = ContentType::contentName($currentPath);

            Storage::move($currentPath, $toUpdate);
            $file = FileMetaData::where(['path' => $currentPath, 'status' => 1])->first();
            $file->update(['nama_file' => $request->nama_file.$request->ext, 'path' => $toUpdate]);

            $currentPath = $toUpdate;

            FileAction::renamed($file, $oldName);
            toastr()->success('File telah diperbarui', 'Sukses');
            return redirect()->back()->with(compact('currentPath'));
        }

        toastr()->info('Tidak ada pembaruan dilakukan', 'Info');
        return redirect()->back()->with(compact('currentPath', 'foldersData', 'filesData'));
    }

    // Menghapus file
    public function delete(Request $request)
    {
        $currentPath = $request->current_path;

        if (Storage::exists($request->current_path)) {
            $currentPath = Str::before($request->current_path, $request->file);
            $toTrash = ContentType::moveToTrash($request->current_path);
            
            if ($toTrash) {
                $file = FileMetaData::where(['path' => $request->current_path, 'status' => 1])->first();
                $file->update(['status' => 0]);
                Storage::delete($request->current_path);
    
                FileAction::deleted($file);
                toastr()->success('File telah dihapus', 'Sukses');
                return redirect()->back()->with(compact('currentPath'));
            }
        } else {
            toastr()->warning('Tidak ada file yang dihapus', 'Peringatan');
            return redirect()->back()->with(compact('currentPath'));
        }
    }

    // Mengganti status file/folder
    // Apabila folder diganti statusnya, maka hal yang sama akan ikut berdampak pada file/folder di dalamnya
    public function changeSharedStatus(Request $request)
    {
        $currentPath = Str::before($request->path, $request->name);

        if ($request->type == 'folder') {
            $folderInsideThisFolder = Folder::where('path', 'LIKE', '%'.$request->path.'%')->where(['status' => 1])->get();
            $fileInsideThisFolder = FileMetaData::where('path', 'LIKE', '%'.$request->path.'%')->where(['status' => 1])->get();

            foreach ($folderInsideThisFolder as $folderHasPrivateParent) {
                if ($request->path != $folderHasPrivateParent->path) {
                    $folderHasPrivateParent->update(['isParentPrivate' => !$folderHasPrivateParent->isParentPrivate]);
                }
            }
            foreach ($fileInsideThisFolder as $fileHasPrivateParent) {
                $fileHasPrivateParent->update(['isParentPrivate' => !$fileHasPrivateParent->isParentPrivate]);
            }

            $folder = Folder::where(['path' => $request->path, 'status' => 1])->first();
            $folder->update(['isPrivate' => !$folder->isPrivate]);

            toastr()->success('Status folder telah diperbarui!', 'Sukses');
            return redirect()->back()->with(compact('currentPath'));
        } else if ($request->type == 'file') {
            $file = FileMetaData::where(['path' => $request->path, 'status' => 1])->first();

            $file->update(['isPrivate' => !$file->isPrivate]);

            toastr()->success('Status file telah diperbarui', 'Sukses');
            return redirect()->back()->with(compact('currentPath'));
        }
        
    }

    // Upload file (function ini digunakan untuk mengupload file baik itu single-file maupun multi-files)
    public function multiUpload(FileUploadRequest $request)
    {
        $currentPath = $request->current_path;
        $size = $request->file_size;

        $fileExists = [];
        $fileUploadSucces = [];

        if (SizeConverter::capacityIsNotFull($size)) {
            if ($request->hasFile('files')) {
                for ($i=0; $i < count($request->isFilePrivate); $i++) { 
                    $file = $request->file('files')[$i];

                    $pathToSave = $request->current_path;
                    $filename = $file->getClientOriginalName();
                    $filesize = $file->getSize();
                    $extension = $file->getClientOriginalExtension();
                    $fullpath = $pathToSave.'/'.$filename;

                    if (!Storage::exists($fullpath)) {
                        Storage::putFileAs($pathToSave, $file, $filename);
                        $f = FileMetaData::create([
                            'id_unit' => Auth::user()->id_unit,
                            'nama_file' => $filename,
                            'size' => $filesize,
                            'extensi' => $extension,
                            'isPrivate' => $request->isFilePrivate[$i],
                            'path' => $fullpath,
                            'status' => 1,
                            'keterangan' => $request->keterangan[$i] == '' ? null : $request->keterangan[$i]
                        ]);

                        FileAction::created($f);
                        $fileUploadSucces[] = $filename;
                    } else {
                        $fileExists[] = $filename;
                    }
                }

                if ($fileUploadSucces != null) {
                    toastr()->success('Upload file berhasil!', 'Sukses');
                }
                if ($fileExists != null) {
                    foreach ($fileExists as $fe) {
                        toastr()->error('File '.$fe.' sudah pernah diupload!', 'Error');
                    }
                }
                return redirect()->back()->with(compact('currentPath'));
            }

            toastr()->error('Gagal upload file!', 'Error');
            return redirect()->back()->with(compact('currentPath'));
        } else {
            toastr()->error('Kapasitas folder tidak mencukupi!', 'Error');
            return redirect()->back()->with(compact('currentPath'));
        }

    }

    // fungsi untuk memperbarui keterangan dari sebuah file
    public function updateKeterangan(Request $request)
    {
        $file = FileMetaData::where('path', $request->path)->first();
        $file->update(['keterangan' => $request->keterangan]);

        return response()->json([
            'data' => $file
        ]);
    }
}
