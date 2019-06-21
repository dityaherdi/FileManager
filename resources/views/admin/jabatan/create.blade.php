@extends('app.app')

@section('css')
    {{-- Additional CSS for this page --}}
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Jabatan</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Jabatan Baru</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('jabatan.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <input type="text" value="{{ old('nama_jabatan') }}" class="form-control" id="namaJabatan" name="nama_jabatan" placeholder="Nama Jabatan">
                    </div>
                    <div class="form-group col-md-2">
                        <button type="submit" href="#" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                            <span class="text">Simpan</span>
                        </button>
                    </div>
                </div>
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