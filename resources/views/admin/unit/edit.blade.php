@extends('app.app')

@section('css')
    {{-- Additional CSS for this page --}}
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Unit</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Perbarui Unit</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('unit.update', $unit->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" value="{{ $unit->id }}" name="id">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="namaUnit">Nama Unit</label>
                        <input type="text" value="{{ $unit->nama_unit }}" class="form-control" id="namaUnit" name="nama_unit" placeholder="Unit">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="namaFolder">Nama Folder</label>
                        <input type="text" readonly value="{{ $unit->nama_folder }}" class="form-control" id="namaFolder" name="nama_folder" placeholder="Folder">                        
                    </div>
                    <div class="form-group col-md-4">
                        <label for="kapasitas">Kapasitas (GB)</label>
                        <input type="number" value="{{ SizeConverter::fromBytesToGiga($unit->kapasitas) }}" class="form-control" id="kapasitas" name="kapasitas">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-inline">
                            <label for="" class="mr-2">Status :</label>
                            <div class="custom-control custom-radio mr-2">
                                <input type="radio" id="inputStatusAktif" {{ $unit->status == 1 ? 'checked' : '' }} value="1" name="status" class="custom-control-input">
                                <label class="custom-control-label" for="inputStatusAktif">Aktif</label>
                            </div>
                            <div class="custom-control custom-radio mr-2">
                                <input type="radio" id="inputStatusNonAktif" {{ $unit->status == 0 ? 'checked' : '' }} value="0" name="status" class="custom-control-input">
                                <label class="custom-control-label" for="inputStatusNonAktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-inline">
                            <label for="" class="mr-2">Khusus Direksi :</label>
                            <div class="custom-control custom-radio mr-2">
                                <input type="radio" id="inputIsDireksi" {{ $unit->isDireksi == 1 ? 'checked' : '' }} value="1" name="isDireksi" class="custom-control-input">
                                <label class="custom-control-label" for="inputIsDireksi">Iya</label>
                            </div>
                            <div class="custom-control custom-radio mr-2">
                                <input type="radio" id="inputIsNotDireksi" {{ $unit->isDireksi == 0 ? 'checked' : '' }} value="0" name="isDireksi" class="custom-control-input">
                                <label class="custom-control-label" for="inputIsNotDireksi">Tidak</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" href="#" class="btn btn-primary btn-icon-split mt-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Perbarui</span>
                </button>
            </form>
        </div>
    </div>
    @php
    if ($errors->any()) {
        foreach ($errors->all() as $message)
        {
            toastr()->error($message, 'Error');
        }
    }
    @endphp
@endsection

@push('js')
    {{-- Additional JS for this page --}}
@endpush