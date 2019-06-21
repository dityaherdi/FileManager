@extends('app.app')

@section('css')
    {{-- Additional CSS File for this page --}}
@endsection

@section('content')
    <div class="jumbotron">
        <div class="text-center">
            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" src="{{ asset('img/file_default.svg') }}" style="width: 200px;" alt="">
            <form action="{{ route('search') }}" method="POST">
                @csrf
                <input style="text-align: center;" name="keyword" class="form-control form-control-lg bg-light" type="text" placeholder="Mencari sesuatu ?">
                <button type="submit" class="btn btn-primary btn-icon-split btn-block mt-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-search"></i>
                    </span>
                    <span class="text">Cari</span>
                </button>
            </form>
        </div>
        <hr class="my-4">
        @isset($key)
            @if ($key != '')
                <h2>Hasil Pencarian : "{{ $key }}"</h2>
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="folder-result-tab" data-toggle="pill" href="#folder-result" role="tab" aria-controls="folder-result" aria-selected="true">
                            Folder <span class="badge badge-info">{{ count($folderResult) }} ditemukan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="file-result-tab" data-toggle="pill" href="#file-result" role="tab" aria-controls="file-result" aria-selected="false">
                            File <span class="badge badge-info">{{ count($fileResult) }} ditemukan</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    @isset($folderResult)
                        <div class="tab-pane fade show active" id="folder-result" role="tabpanel" aria-labelledby="folder-result-tab">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Folder</th>
                                            <th scope="col">Unit</th>
                                            <th scope="col">Path</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($folderResult as $folder)
                                            <tr>
                                                <th scope="row">{{ $no++ }}</th>
                                                <td>{{ $folder->nama_folder }}</td>
                                                <td>{{ $folder->unit->nama_unit }}</td>
                                                <td>{{ ContentType::relativePath($folder->path) }}</td>
                                                <td>
                                                    <button onclick="toDestination('{{ $folder->path }}')" class="btn btn-info btn-circle btn-sm" title="Lokasi Folder">
                                                        <i class="fas fa-location-arrow"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endisset
                    @isset($fileResult)
                        <div class="tab-pane fade" id="file-result" role="tabpanel" aria-labelledby="file-result-tab">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama File</th>
                                            <th scope="col">Unit</th>
                                            <th scope="col">Path</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($fileResult as $file)
                                            <tr>
                                                <th scope="row">{{ $no++ }}</th>
                                                <td>{{ $file->nama_file }}</td>
                                                <td>{{ $file->unit->nama_unit }}</td>
                                                <td>{{ ContentType::relativePath($file->path) }}</td>
                                                <td>
                                                    <button onclick="toDownload('{{ $file->path }}')" class="btn btn-secondary btn-circle btn-sm" title="Download File">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                    <button onclick="toDestination('{{ $file->path }}')" class="btn btn-info btn-circle btn-sm" title="Lokasi File">
                                                        <i class="fas fa-location-arrow"></i>
                                                    </button>
                                                    <button onclick="detail('{{ $file->path }}')" class="btn btn-warning btn-circle btn-sm" title="Preview File">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endisset
                </div>
            @else
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Hasil pencarian "{{ $oldKey }}" tidak ditemukan!.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        @endisset
    </div>

    <form action="{{ route('toDestination') }}" method="GET" style="display: none;" id="formToDestination">
        @csrf
        <input type="hidden" id="pathToDestination" name="path" value="">
        {{-- <input type="hidden" id="folderFormtoDestination" name="destination" value=""> --}}
    </form>

    <form action="{{ route('file.download') }}" method="GET" style="display: none;" id="formDownloadFile">
        @csrf
        <input type="hidden" id="current_pathFormDownloadFile" name="current_path" value="">
        {{-- <input type="hidden" id="fileFormDownloadFile" name="file" value=""> --}}
    </form>
    {{-- detail file --}}
    <form action="{{ route('file.detail') }}" method="GET" style="display: none;" id="formDetail">
        @csrf
        <input type="hidden" id="current_pathFormDetail" name="current_path" value="">
    </form>
@endsection

@push('scripts')
    {{-- Additional JS File for this page --}}
    <script>
        function toDestination(path) {
            $('#pathToDestination').val(path)
            $('#formToDestination').submit()
        }

        function toDownload(path) {
            $('#current_pathFormDownloadFile').val(path)
            $('#formDownloadFile').submit()
        }

        function detail(path) {
            $('#current_pathFormDetail').val(path)
            $('#formDetail').submit()
        }
    </script>
@endpush