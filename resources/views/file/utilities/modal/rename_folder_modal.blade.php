<!-- Modal -->
<div class="modal fade" id="renameFolderModal" tabindex="-1" role="dialog" aria-labelledby="renameFolderModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ubah Nama Folder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('folder.rename') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="hidden" id="current_pathRenameForm" name="current_path" value="">
                        <input type="hidden" id="current_nameRenameForm" name="current_name" value="">
                        <input type="text" id="nama_folderRenameForm" class="form-control" name="nama_folder" placeholder="Nama Folder">
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