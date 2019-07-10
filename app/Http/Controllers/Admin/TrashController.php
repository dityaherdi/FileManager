<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Trash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class TrashController extends Controller
{
    public function index()
    {
        $trashes = Trash::where(['isTrashRemovedPermanently' => 0])->orderBy('expired_date')->get();
        return view('admin.trash.index', compact('trashes'));
    }

    public function permanentDelete($id)
    {
        $zipToDelete = Trash::findOrFail($id);
        $zipToDelete->update([
            'isTrashRemovedPermanently' => 1
        ]);

        unlink($zipToDelete->trash_path);
        
        toastr()->success('File sudah dihapus secara permanen!', 'Sukses');
        return redirect()->back();
    }

    public function cleanUp()
    {
        $trashesToDelete = Trash::where(['isTrashRemovedPermanently' => 0])->whereDate('expired_date', '<=', Carbon::now())->get();

        if ($trashesToDelete->count() > 0) {
            foreach ($trashesToDelete as $trash) {
                $trash->update([
                    'isTrashRemovedPermanently' => 1
                ]);
                unlink($trash->trash_path);
            }

            toastr()->success('ZIP kadaluarsa sudah dibersihkan', 'Sukses');
            return redirect()->back();
        } else {
            toastr()->warning('Tidak ada ZIP yang dapat dibersihkan', 'Peringatan');
            return redirect()->back();
        }
    }
}
