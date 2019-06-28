@extends('app.app')

@section('css')
    {{-- Additional CSS File for this page --}}
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    {{-- Breadcrumb --}}
    @if ($currentPath != 'public')
        <nav aria-label="breadcrumb" class="mt-3">
            <ol class="breadcrumb">
                @php
                    $folderName = explode('/', $currentPath);
                @endphp
                @foreach ($folderName as $fn)
                    @if ($fn != 'public')
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="javascript:void(0);"
                                onclick="next('{{ ContentType::breadcrumbPath($currentPath, $fn) }}', '{{ $fn }}')">
                                {{ $fn }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ol>
        </nav>
    @endif
    {{-- End Breadcrumb --}}

    <!-- DataTables -->
    <div class="card shadow mb-4">
        {{-- <div class="card-header d-sm-flex justify-content-between py-3">
            <h6 class="m-0 font-weight-bold text-primary">Files</h6>
        </div> --}}
        <div class="card-body">

            <a href="javascript:void(0)" 
                onclick="back('{{ ContentType::parentPath($currentPath) }}', '{{ $currentPath }}')"
                class="btn btn-info btn-circle" title="Kembali">
                <i class="fas fa-arrow-left"></i>
            </a>
            
            @if (ContentType::rootUnit($currentPath))
                @can('create')
                    <button class="btn btn-info btn-circle" data-toggle="modal" data-target="#newFolderModal" title="Folder Baru">
                        <i class="fas fa-folder-plus"></i>
                    </button>
                    @include('file.utilities.modal.new_folder_modal')

                    <button class="btn btn-info btn-circle" id="uploadButton" data-toggle="modal" data-target="#uploadModal" title="Upload File">
                        <i class="fas fa-upload"></i>
                    </button>
                    @include('file.utilities.modal.upload_modal')
                @endcan
                @if (Auth::user()->isAdmin)
                    @if ($currentPath != 'public')
                        <hr>
                        <div class="progress mt-2" style="height: 20px;">
                            <div style="width: {{ SizeConverter::capacityWidthForAdmin($currentPath) }}%;"
                                class="progress-bar progress-bar-striped progress-bar-animated
                                    {{ SizeConverter::capacityColor(SizeConverter::capacityWidthForAdmin($currentPath)) }}
                                font-weight-bold text-gray-900"
                                role="progressbar">
                                {{ SizeConverter::diskSpaceForAdmin($currentPath) }}
                            </div>
                        </div>
                    @endif
                @else
                    <hr>
                    <div class="progress mt-2" style="height: 20px;">
                        <div style="width: {{ SizeConverter::capacityWidth() }}%;"
                            class="progress-bar progress-bar-striped progress-bar-animated
                                {{ SizeConverter::capacityColor(SizeConverter::capacityWidth()) }}
                            font-weight-bold text-gray-900"
                            role="progressbar">
                            {{ SizeConverter::diskSpace() }}
                        </div>
                    </div>
                @endif
            @endif

            @include('file.utilities.modal.rename_folder_modal')
            @include('file.utilities.modal.rename_file_modal')
            @include('file.utilities.modal.change_status_modal')

            <hr>
            <div class="table-responsive">
            <table class="table table-sm table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Size</th>
                        <th>Modified</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $paths = ContentType::private($paths);
                        $foldersData = GlobalVariable::foldersData();
                        $filesData = GlobalVariable::filesData();
                    @endphp
                    @foreach ($paths as $path)
                        <tr>
                            {{-- Nama --}}
                            <td>
                                @if (ContentType::checkType($path) == 'folder')
                                    <i class="fas fa-folder mr-2"></i>
                                    <a href="javascript:void(0);" onclick="next('{{ $path }}', '{{ ContentType::contentName($path) }}')">
                                        {{ ContentType::contentName($path) }}
                                    </a>
                                @else
                                    <i class="fas fa-file mr-2"></i>
                                    {{ ContentType::contentName($path) }}
                                @endif
                            </td>
                            {{-- End Nama --}}

                            {{-- Size --}}
                            <td>
                                @if (ContentType::checkType($path) == 'folder')
                                    {{ SizeConverter::folderSize($path) }}
                                @else
                                    {{ SizeConverter::fileSize($path) }}
                                @endif
                            </td>
                            {{-- End Size --}}

                            {{-- Modified --}}
                            <td>
                               {{ ContentType::modified($path) }}
                            </td>
                            {{-- End Modified --}}

                            {{-- Status --}}
                            <td>
                                @if (ContentType::checkType($path) == 'folder')
                                    @if (ContentType::contentStatus($path, $foldersData) == 'Private')
                                        <button {{ ContentType::renderActionButton($path) == 0 ? 'disabled' : '' }}
                                            onclick="openStatusModal('{{ $path }}', '{{ ContentType::contentStatus($path, $foldersData) }}', '{{ ContentType::contentName($path) }}', '{{ contentType::checkType($path) }}')"
                                            class="btn btn-warning btn-icon-split btn-sm btn-block">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <span class="text">{{ ContentType::contentStatus($path, $foldersData) }}</span>
                                        </button>
                                    @else
                                        <button {{ ContentType::renderActionButton($path) == 0 ? 'disabled' : '' }}
                                            onclick="openStatusModal('{{ $path }}', '{{ ContentType::contentStatus($path, $foldersData) }}', '{{ ContentType::contentName($path) }}', '{{ contentType::checkType($path) }}')"
                                            class="btn btn-info btn-icon-split btn-sm btn-block">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-globe-asia"></i>
                                            </span>
                                            <span class="text">{{ ContentType::contentStatus($path, $foldersData) }}</span>
                                        </button>
                                    @endif
                                @else
                                    @if (ContentType::contentStatus($path, $filesData) == 'Private')
                                        <button {{ ContentType::renderActionButton($path) == 0 ? 'disabled' : '' }}
                                            onclick="openStatusModal('{{ $path }}', '{{ ContentType::contentStatus($path, $filesData) }}', '{{ ContentType::contentName($path) }}', '{{ contentType::checkType($path) }}')"
                                            class="btn btn-warning btn-icon-split btn-sm btn-block">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <span class="text">{{ ContentType::contentStatus($path, $filesData) }}</span>
                                        </button>
                                    @else
                                        <button {{ ContentType::renderActionButton($path) == 0 ? 'disabled' : '' }}
                                            onclick="openStatusModal('{{ $path }}', '{{ ContentType::contentStatus($path, $filesData) }}', '{{ ContentType::contentName($path) }}', '{{ contentType::checkType($path) }}')"
                                            class="btn btn-info btn-icon-split btn-sm btn-block">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-globe-asia"></i>
                                            </span>
                                            <span class="text">{{ ContentType::contentStatus($path, $filesData) }}</span>
                                        </button>
                                    @endif
                                @endif
                            </td>
                            {{-- End Status --}}

                            {{-- Action --}}
                            <td>
                                {{-- {{ ContentType::renderOptionButton() }} --}}
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="optionDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-cogs mr-2"></i> Option
                                    </button>
                                    <div class="dropdown-menu" id="actionDropdownMenu" aria-labelledby="optionDropdown">
                                        @if (ContentType::checkType($path) == 'folder')
                                            @if (ContentType::renderActionButton($path))
                                                @can('update')
                                                    <a href="javascript:void(0)" class="dropdown-item" title="Rename" id="renameFolder"
                                                        onclick="renameFolder('{{ $path }}', '{{ ContentType::contentName($path) }}')">
                                                        <i class="fas fa-pencil-alt mr-2"></i>Rename
                                                    </a>
                                                @endcan
                                                @can('delete')
                                                    <a href="javascript:void(0)" class="dropdown-item" id="btnDeleteFolder" title="Delete Folder"
                                                        onclick="confirmDeleteFolder('{{ $path }}', '{{ ContentType::contentName($path) }}')">
                                                        <i class="fas fa-trash mr-2"></i>Delete
                                                    </a>
                                                @endcan
                                            @else
                                            <a href="#" class="dropdown-item">
                                                <i class="fas fa-ban mr-2"></i>Hak Akses Tidak Tersedia
                                            </a>
                                            @endif
                                        @else
                                            @can('download')
                                                <a href="javascript:void(0)" class="dropdown-item" id="btnDownloadFile" title="Download File"
                                                    onclick="downloadFile('{{ $path }}', '{{ ContentType::contentName($path) }}')">
                                                    <i class="fas fa-download mr-2"></i>Download
                                                </a>
                                            @endcan
                                            @can('view')
                                                <a href="javascript:void(0)" class="dropdown-item" id="btnDetail" title="Preview Detail"
                                                    onclick="detail('{{ $path }}')">
                                                    <i class="fas fa-eye mr-2"></i>View
                                                </a>
                                            @endcan

                                            @if (ContentType::renderActionButton($path))
                                                @can('update')
                                                    <a href="javascript:void(0)" class="dropdown-item" title="Rename" id="btnRenameFile"
                                                        onclick="renameFile('{{ $path }}', '{{ ContentType::contentName($path) }}', '{{ ContentType::nameOnly($path) }}', '{{ ContentType::getExtension($path) }}')">
                                                        <i class="fas fa-pencil-alt mr-2"></i>Rename
                                                    </a>
                                                @endcan
                                                @can('delete')
                                                    <a href="javascript:void(0)" class="dropdown-item" id="btnDeleteFile" title="Delete File"
                                                        onclick="confirmDeleteFile('{{ $path }}', '{{ ContentType::contentName($path) }}')">
                                                        <i class="fas fa-trash mr-2"></i>Delete
                                                    </a>
                                                @endcan
                                            @else
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-ban mr-2"></i>Hak Akses Tidak Tersedia
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                
                            </td>
                            {{-- End Action --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @include('file.utilities.forms.forms')
            </div>
        </div>
        <div class="card-footer text-right">
            Total Folder : {{ ContentType::countFolder($currentPath) }} | Total File : {{ ContentType::countFile($currentPath) }}
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

@push('scripts')
    {{-- Additional JS File for this page --}}
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('js/custom/file-index.js') }}"></script>
    
@endpush