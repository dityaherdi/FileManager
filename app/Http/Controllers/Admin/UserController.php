<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Unit;
use App\Jabatan;
use App\Permission;
use App\Folder;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUser = User::latest()->get();
        return view('admin.user.index', compact('dataUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataUnit = Unit::all();
        $dataJabatan = Jabatan::all();
        return view('admin.user.create', compact('dataUnit', 'dataJabatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(UserRequest $request)
    public function store(Request $request)
    {
        if ($request->id_unit == 'Administrator') {
            $id = Unit::where(['nama_unit' => $request->id_unit, 'status' => 1])->value('id');
            $request->merge(['id_unit' => $id, 'isAdmin' => 1]);
        }

        $hashPassword = bcrypt($request->password);
        $request->merge(['password' => $hashPassword]);

        $user = User::create($request->all());

        Permission::create([
            'id_user' => $user->id,
        ]);

        toastr()->success('User '.$user->nama_user.' telah ditambahkan!', 'Sukses');
        return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $dataUnit = Unit::all();
        $dataJabatan = Jabatan::all();
        return view('admin.user.edit', compact('user', 'dataUnit', 'dataJabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->id_unit == 'Administrator') {
            $id = Unit::where(['nama_unit' => $request->id_unit, 'status' => 1])->value('id');
            $request->merge(['id_unit' => $id, 'isAdmin' => 1]);
        }

        if (is_null($request->password)) {
            $user = User::findOrFail($id)->update($request->except(['password']));

            toastr()->success('User '.$request->nik.' telah diperbarui');
            return redirect(route('user.index'));
        } else {
            $hashPassword = bcrypt($request->password);
            $request->merge(['password' => $hashPassword]);
            $user = User::findOrFail($id)->update($request->all());

            toastr()->success('User '.$request->nik.' telah diperbarui!');
            return redirect(route('user.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        toastr()->success('User '.$user->nik.' telah dihapus!');
        return redirect(route('user.index'));
    }
}
