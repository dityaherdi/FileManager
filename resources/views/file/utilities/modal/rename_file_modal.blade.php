<!-- Modal -->
<div class="modal fade" id="renameFileModal" tabindex="-1" role="dialog" aria-labelledby="renameFileModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ubah Nama File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('file.rename') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="hidden" id="current_pathRenameFileForm" name="current_path" value="">
                        <input type="hidden" id="current_nameRenameFileForm" name="current_name" value="">
                        <input type="text" maxlength="100" id="nama_fileRenameFileForm" class="form-control" name="nama_file">
                        <input type="text" readonly id="ext" class="form-control" name="ext" value="" style="max-width: 100px;">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-icon-split" type="submit">
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
    </div>
</div>