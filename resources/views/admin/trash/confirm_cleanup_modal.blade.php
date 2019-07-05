<!-- Modal -->
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeStatusModalTitle">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                  <h4 class="alert-heading"> <i class="fas fa-exclamation-triangle"></i> PERINGATAN!</h4>
                  <p>
                    Melakukan Space Clean-Up berarti menghapus semua ZIP file yang sudah expired. Mohon dipastikan apakah anda yakin akan membersihkan ruang ?
                  </p>
                  <hr>
                  <p class="mb-0">File ZIP yang dihapus akan hilang secara permanen dan tidak dapat dikembalikan !</p>
                </div>
            </div>
            <div class="modal-footer d-sm-flex align-items-center justify-content-between">
              <button href="#" class="btn btn-secondary btn-icon-split btn-sm" data-dismiss="modal">
                <span class="icon text-white-50">
                    <i class="fas fa-ban"></i>
                </span>
                <span class="text">Batal</span>
              </button>
              <a href="{{ route('trash.cleanup') }}" class="btn btn-danger btn-icon-split btn-sm">
                <span class="icon text-white-50">
                    <i class="fas fa-bolt"></i>
                </span>
                <span class="text">Hapus Permanen</span>
              </a>
            </div>
        </div>
    </div>
</div>