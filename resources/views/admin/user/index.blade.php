@extends('app.app')

@section('css')
    {{-- Additional CSS File for this page --}}
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User</h1>
        <a href="{{ route('user.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus-circle"></i>
            </span>
            <span class="text">Tambah User</span>
        </a>
    </div>

    <!-- DataTables -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Master Data User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($dataUser as $user)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $user->nama_user }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-pen-alt"></i>
                                </span>
                                <span class="text">Edit</span>
                            </a>
                            <button class="btn btn-sm btn-danger btn-icon-split" type="submit" onclick="confirmDelete(event, {{ $user }})">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">
                                    Delete
                                </span>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <form action="" id="formDeleteUser" method="post" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete (event, user) {
            var urlDeleteUser = '{{ route("user.destroy", ":id") }}'
            urlDeleteUser = urlDeleteUser.replace(':id', user.id)

            Swal.fire({
                title: 'Hapus User '+user.nama_user+' ?',
                text: "User yang dihapus tidak dapat dikembalikan!",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus'
                }).then((result) => {
                if (result.value) {
                    event.preventDefault()
                    $('#formDeleteUser').attr('action', urlDeleteUser).submit()                
                }
            })
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