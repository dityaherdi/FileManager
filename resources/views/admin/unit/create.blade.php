@extends('app.app')

@section('css')
    {{-- Additional CSS for this page --}}
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Unit</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Unit Baru</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('unit.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="namaUnit">Nama Unit</label>
                        <input type="text" value="{{ old('nama_unit') }}" class="form-control" id="namaUnit" name="nama_unit" placeholder="Unit">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="namaFolder">Nama Folder</label>
                        <input type="text" value="{{ old('nama_folder') }}" class="form-control" id="namaFolder" name="nama_folder" placeholder="Folder">                        
                    </div>
                    <div class="form-group col-md-4">
                        <label for="kapasitas">Kapasitas (GB)</label>
                        <input type="number" value="{{ old('nama_folder') }}" class="form-control" id="kapasitas" name="kapasitas">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Status :</label>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="inputStatusAktif" value="1" name="status" class="custom-control-input">
                        <label class="custom-control-label" for="inputStatusAktif">Aktif</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="inputStatusNonAktif" value="0" name="status" class="custom-control-input">
                        <label class="custom-control-label" for="inputStatusNonAktif">Tidak Aktif</label>
                    </div>
                </div>
                <button type="submit" href="#" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Simpan</span>
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