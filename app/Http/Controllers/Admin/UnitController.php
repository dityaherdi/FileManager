<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Unit;
use App\Http\Requests\UnitRequest;
use App\Helpers\SizeConverter;
use Illuminate\Support\Facades\Storage;
use App\Folder;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUnit = Unit::latest()->where('nama_unit', '!=', 'Administrator')->get();
        return view('admin.unit.index', compact('dataUnit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.unit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitRequest $request)
    {
        // Make root folder each unit
        $folderPath = storage_path('app/public/'.$request->nama_folder);
        $relativePath = 'public/'.$request->nama_folder;

        if (!is_dir($folderPath)) {
            Storage::makeDirectory('public/'.$request->nama_folder);

            $convertedKapasitasToBytes = SizeConverter::fromGigaToBytes($request->kapasitas);
            $request->merge(['kapasitas'  => $convertedKapasitasToBytes]);
            $unit = Unit::create($request->all());

            Folder::create([
                'id_unit' => $unit->id,
                'nama_folder' => $request->nama_folder,
                'path' => $relativePath,
                'root' => 1,
                'isPrivate' => 0
            ]);

            toastr()->success('Unit '.$unit->nama_unit.' telah ditambahkan!', 'Sukses');
            return redirect(route('unit.index'));
        } else {
            toastr()->error('Nama folder sudah digunakan!', 'Error');
            return redirect()->back();
        }

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
        $unit = Unit::findOrFail($id);
        return view('admin.unit.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnitRequest $request, $id)
    {
        $convertedKapasitasToBytes = SizeConverter::fromGigaToBytes($request->kapasitas);

        $request->merge(['kapasitas'  => $convertedKapasitasToBytes]);
        $unit = Unit::findOrFail($id)->update($request->all());
        toastr()->success('Unit telah diperbarui!', 'Sukses');
        return redirect(route('unit.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        
        toastr()->success('Unit '.$unit->nama_unit.' telah dihapus!', 'Sukses');
        return redirect(route('unit.index'));
    }
}
