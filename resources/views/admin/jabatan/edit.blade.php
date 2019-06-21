@extends('app.app')

@section('css')
    {{-- Additional CSS for this page --}}
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Jabatan</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Perbarui Jabatan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" value="{{ $jabatan->id }}" name="id">
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <input type="text" class="form-control" id="namaJabatan" name="nama_jabatan" value="{{ $jabatan->nama_jabatan }}" placeholder="Nama Jabatan">
                    </div>
                    <div class="form-group col-md-2">
                        <button type="submit" href="#" class="btn btn-info btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                            <span class="text">Perbarui</span>
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