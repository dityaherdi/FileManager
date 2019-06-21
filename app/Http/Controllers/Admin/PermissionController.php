<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use App\User;
use Auth;

class PermissionController extends Controller
{
    public function index()
    {
        if (Auth::user()->isAdmin) {
            $permission = Permission::with('user')->get();
        } else {
            $permission = Permission::with('user')->whereHas('user', function ($query) {
                $query->where(['id_unit' => Auth::user()->id_unit, 'isManager' => 0]);
            })->get();
        }
        // dd($permission);
        return view('admin.akses.index', compact('permission'));
    }

    public function updateAkses(Request $request)
    {
        $permission = Permission::where(['id_user' => $request->id_user])->first();
        $permission->view = $this->checkbox($request->view);
        $permission->create = $this->checkbox($request->create);
        $permission->update = $this->checkbox($request->update);
        $permission->delete = $this->checkbox($request->delete);
        $permission->save();

        toastr()->success('Hak Akses telah diperbarui', 'Sukses');
        return redirect(route('akses.index'));
    }

    public function checkbox($value)
    {
        if (isset($value)) {
            return 1;
        } else {
            return 0;
        }
        
    }
}
