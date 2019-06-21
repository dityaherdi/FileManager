<!-- Modal -->
<div class="modal fade" id="newFolderModal" tabindex="-1" role="dialog" aria-labelledby="newFolderModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Folder Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('folder.create') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="hidden" name="current_path" value="{{ $currentPath }}" id="">
                        <input type="text" class="form-control" name="nama_folder" placeholder="Nama Folder">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-icon-split" type="submit">
                                <span class="icon text-white-50">
                                    <i class="fas fa-save"></i>
                                </span>
                                <span class="text">Simpan</span>
                            </button>
                        </div>
                    </div>
                    <label for="" class="mr-2">Status Folder :</label>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio form-check form-check-inline">
                            <input type="radio" id="inputPrivateFolder" value="1" name="isFolderPrivate" class="custom-control-input" required>
                            <label class="custom-control-label" for="inputPrivateFolder">Private</label>
                        </div>
                    </div>
                    <div class="form-check form-check-inline">
                        <div class="custom-control custom-radio form-check form-check-inline">
                            <input type="radio" id="inputSharedFolder" value="0" name="isFolderPrivate" class="custom-control-input">
                            <label class="custom-control-label" for="inputSharedFolder">Shared</label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>