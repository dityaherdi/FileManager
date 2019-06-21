<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{-- Commented code below used for single file upload, but no longer used --}}
                {{-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="single-file-tab" data-toggle="pill" href="#single-file" role="tab" aria-controls="single-file" aria-selected="true">
                            Single File
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="multi-file-tab" data-toggle="pill" href="#multi-file" role="tab" aria-controls="multi-file" aria-selected="false">
                            Multi Files
                        </a>
                    </li>
                </ul>
                <hr> --}}
                {{-- <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="single-file" role="tabpanel" aria-labelledby="single-file-tab">
                        <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="{{ $currentPath }}" name="current_path">
                            <input type="hidden" value="" name="file_size" id="single_file_size">
                            @csrf
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="uploadFile" name="file">
                                <label class="custom-file-label" for="uploadFile">Pilih File</label>
                            </div>
                            <label for="" class="mr-2">Status File :</label>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio form-check form-check-inline">
                                    <input type="radio" id="inputPrivateFile" value="1" name="isFilePrivate" class="custom-control-input" required>
                                    <label class="custom-control-label" for="inputPrivateFile">Private</label>
                                </div>
                            </div>
                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-radio form-check form-check-inline">
                                    <input type="radio" id="inputSharedFile" value="0" name="isFilePrivate" class="custom-control-input">
                                    <label class="custom-control-label" for="inputSharedFile">Shared</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan <i><small>(dapat dikosongkan)</small></i> :</label>
                                <textarea class="form-control" id="keterangan" rows="3" name="keterangan"></textarea>
                            </div>
                            <div class="input-group-append mt-2">
                                <button class="btn btn-primary btn-icon-split btn-sm btn-block" type="submit">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="text">Upload</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="multi-file" role="tabpanel" aria-labelledby="multi-file-tab">
                        <form action="{{ route('file.multi.upload') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <small class="text-muted">*Multi file yang diupload secara otomatis memiliki status "Shared"</small>
                            <input type="hidden" value="{{ $currentPath }}" name="current_path">
                            <input type="hidden" value="" name="file_size" id="multi_file_size">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="multiFiles" name="files[]" multiple>
                                <label class="custom-file-label" for="multiFiles">Pilih File</label>
                            </div>
                            <ul id="multi-filename" class="list-group mt-2">
                            </ul>
                            <div class="input-group-append mt-2">
                                <button class="btn btn-primary btn-icon-split btn-sm btn-block" type="submit">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="text">Upload</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div> --}}
                {{-- <div class="tab-pane fade" id="multi-file" role="tabpanel" aria-labelledby="multi-file-tab"> --}}
                        <form action="{{ route('file.multi.upload') }}" method="POST" enctype="multipart/form-data" id="multiUploadForms">
                            @csrf
                            <input type="hidden" value="{{ $currentPath }}" name="current_path">
                            <input type="hidden" value="" name="file_size" id="multi_file_size">
                            <small class="text-muted">*Maksimal untuk 1x upload sebanyak 10 file</small>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="multiFiles" name="files[]" multiple>
                                <label class="custom-file-label" for="multiFiles">Pilih File</label>
                            </div>
                            <ul id="multi-filename" class="list-group mt-2">
                            </ul>
                            <div class="input-group-append mt-2">
                                <button class="btn btn-primary btn-icon-split btn-sm btn-block" onclick="validateUpload()">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="text">Upload</span>
                                </button>
                            </div>
                        </form>
                        @push('scripts')
                            <script>
                                function validateUpload() {
                                    event.preventDefault()
                                    if ($('#multiFiles')[0].files.length === 0) {
                                        Swal.fire({
                                            title: 'Perhatian!',
                                            text: "Tidak ada file yang diupload",
                                            type: 'info',
                                            confirmButtonColor: '#3085d6'
                                        })
                                    } else {
                                        $('#multiUploadForms').submit()
                                    }
                                }
                            </script>
                        @endpush
                    {{-- </div> --}}
            </div>
        </div>
    </div>
</div>