@extends('app.app')

@section('css')
    {{-- Additional CSS File for this page --}}
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Hak Akses User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama User</th>
                        <th>Hak Akses</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permission as $per)
                        @if ($per->user->nama_user != 'Administrator')
                            <tr>
                                <td>{{ $per->user->nik }}</td>
                                <td>{{ $per->user->nama_user }}</td>
                                <td>
                                    <form action="{{ route('akses.update') }}" class="form-inline" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $per->user->id }}" name="id_user">
                                        <div class="custom-control custom-checkbox form-check-inline">
                                            <input type="checkbox" class="custom-control-input" id="{{ $per->user->nik }}view"
                                                {{ $per->view == 1 ? 'checked' : '' }} name="view" autocomplete="off">
                                            <label class="custom-control-label" for="{{ $per->user->nik }}view">View</label>
                                        </div>
                                        <div class="custom-control custom-checkbox form-check-inline">
                                            <input type="checkbox" class="custom-control-input" id="{{ $per->user->nik }}create"
                                                {{ $per->create == 1 ? 'checked' : '' }} name="create" autocomplete="off">
                                            <label class="custom-control-label" for="{{ $per->user->nik }}create">Create</label>
                                        </div>
                                        <div class="custom-control custom-checkbox form-check-inline">
                                            <input type="checkbox" class="custom-control-input" id="{{ $per->user->nik }}update"
                                                {{ $per->update == 1 ? 'checked' : '' }} name="update" autocomplete="off">
                                            <label class="custom-control-label" for="{{ $per->user->nik }}update">Update</label>
                                        </div>
                                        <div class="custom-control custom-checkbox form-check-inline">
                                            <input type="checkbox" class="custom-control-input" id="{{ $per->user->nik }}delete"
                                                {{ $per->delete == 1 ? 'checked' : '' }} name="delete" autocomplete="off">
                                            <label class="custom-control-label" for="{{ $per->user->nik }}delete">Delete</label>
                                        </div>
                                        <div class="custom-control custom-checkbox form-check-inline">
                                            <input type="checkbox" class="custom-control-input" id="{{ $per->user->nik }}download"
                                                {{ $per->download == 1 ? 'checked' : '' }} name="download" autocomplete="off">
                                            <label class="custom-control-label" for="{{ $per->user->nik }}download">Download</label>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-icon-split btn-sm">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-check"></i>
                                            </span>
                                            <span class="text">Simpan</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    {{-- Additional JS File for this page --}}
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

@endpush