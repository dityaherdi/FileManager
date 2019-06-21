@extends('app.app')

@section('css')
    {{-- Additional CSS for this page --}}
    <link rel="stylesheet" href="{{ asset('vendor/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Perbarui User</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNik">NIK :</label>
                        <input type="text" name="nik" value="{{ $user->nik }}" readonly class="form-control" id="inputNik" placeholder="cth. 1903774">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputEmail">Email :</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="inputEmail" placeholder="user@mail.com">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputNama">Nama User :</label>
                        <input type="text" name="nama_user" value="{{ $user->nama_user }}" class="form-control" id="inputNama" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword">Password :</label>
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputUnit">Unit :</label>
                        <select name="id_unit" id="inputUnit" class="custom-select">
                            <option value="">Pilih Unit</option>
                            @foreach ($dataUnit as $unit)
                                <option value="{{ $unit->id }}" {{ $unit->id == $user->id_unit ? 'selected' : '' }} >{{ $unit->nama_unit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputJabatan">Jabatan :</label>
                        <select name="id_jabatan" id="inputJabatan" class="custom-select">
                            <option value="">Pilih Jabatan</option>
                            @foreach ($dataJabatan as $jabatan)
                                <option value="{{ $jabatan->id }}" {{ $jabatan->id == $user->id_jabatan ? 'selected' : ''}} >{{ $jabatan->nama_jabatan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="form-group"> --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-inline">
                            <label for="" class="mr-2">Status :</label>
                            <div class="custom-control custom-radio mr-2">
                                <input type="radio" id="inputStatusAktif" {{ $user->status == 1 ? 'checked' : '' }} value="1" name="status" class="custom-control-input">
                                <label class="custom-control-label" for="inputStatusAktif">Aktif</label>
                            </div>
                            <div class="custom-control custom-radio mr-2">
                                <input type="radio" id="inputStatusNonAktif" {{ $user->status == 0 ? 'checked' : '' }} value="0" name="status" class="custom-control-input">
                                <label class="custom-control-label" for="inputStatusNonAktif">Tidak Aktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-inline">
                            <label for="" class="mr-2">Internal User Manager :</label>
                            <div class="custom-control custom-radio mr-2">
                                <input type="radio" id="inputIsManager" {{ $user->isManager == 1 ? 'checked' : '' }} value="1" name="isManager" class="custom-control-input">
                                <label class="custom-control-label" for="inputIsManager">Iya</label>
                            </div>
                            <div class="custom-control custom-radio mr-2">
                                <input type="radio" id="inputIsNotManager" {{ $user->isManager == 0 ? 'checked' : '' }} value="0" name="isManager" class="custom-control-input">
                                <label class="custom-control-label" for="inputIsNotManager">Tidak</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-icon-split mt-2">
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
    {{-- <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.custom-select').select2();
        });
    </script> --}}
@endpush