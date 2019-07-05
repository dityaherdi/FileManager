@extends('app.app')

@section('css')
    {{-- Additional CSS File for this page --}}
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Page Heading -->
    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jabatan</h1>
        <a href="{{ route('jabatan.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus-circle"></i>
            </span>
            <span class="text">Tambah Jabatan</span>
        </a>
    </div> --}}

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">ZIP Files</h6>
                    {{-- <a href="{{ route('trash.cleanup') }}" class="btn btn-dark btn-icon-split btn-sm"> --}}
                    <button onclick="changeStatusModal()" class="btn btn-dark btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-bolt"></i>
                    </span>
                    <span class="text">Clean-Up Space</span>
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Unit</th>
                    <th>Tipe</th>
                    <th>Nama ZIP File</th>
                    <th>Expired Date</th>
                    <th>Status Expired</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($trashes as $trash)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $trash->nama_unit }}</td>
                        <td>{{ $trash->isFile ? 'File' : 'Folder' }}</td>
                        <td>{{ $trash->nama_trash }}</td>
                        <td>{{ $trash->expired_date }}</td>
                        <td>
                            @if (ContentType::isExpired($trash->expired_date))
                                <span class="badge badge-danger">Expired</span>
                            @else
                                <span class="badge badge-success">Available</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger btn-icon-split" type="submit" onclick="confirmPermanentDelete(event, {{ $trash }})">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">
                                    Delete Permanen
                                </span>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <form action="" id="formDeletePermanen" method="post" style="display: none;">
                @csrf
            </form>
            </div>
        </div>
    </div>

    @include('admin.trash.confirm_cleanup_modal')

    <script>
        function confirmPermanentDelete (event, trash) {
            var urlDeleteTrash = '{{ route("trash.destroy", ":id") }}'
            urlDeleteTrash = urlDeleteTrash.replace(':id', trash.id)

            Swal.fire({
                title: 'Hapus ZIP ini ?',
                text: "Arsip ini akan dihapus secara permanen. Lanjutkan?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus'
                }).then((result) => {
                if (result.value) {
                    event.preventDefault()
                    $('#formDeletePermanen').attr('action', urlDeleteTrash).submit()
                }
            })
        }

        function changeStatusModal() {
            $('#changeStatusModal').modal('show')
        }
    </script>
@endsection

@push('scripts')
    {{-- Additional JS File for this page --}}
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endpush