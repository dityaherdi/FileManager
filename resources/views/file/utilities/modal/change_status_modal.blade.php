<!-- Modal -->
<div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeStatusModalTitle">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('status.change') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="path" id="contentPath" value="">
                    <input type="hidden" name="type" id="contentType" value="">
                    <input type="hidden" name="name" id="contentName" value="">
                    <p id="confirmationText"></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-icon-split btn-sm" data-dismiss="modal">
                        <span class="icon text-white-50">
                            <i class="fas fa-times"></i>
                        </span>
                        <span class="text">Tidak</span>
                    </button>
                    <button type="submit" class="btn btn-primary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Ya</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>