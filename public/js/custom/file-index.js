$('#dataTable').dataTable( {
            "ordering": false,
        });

        function openStatusModal(path, status, name, type) {
            let invert = ''
            if (status == 'Private') {
                invert = 'Shared'
            }

            if (status == 'Shared') {
                invert = 'Private'
            }

            $('#confirmationText').html('Ubah status '+ type + ' "'+ name +'" dari "'+status+'" menjadi "'+invert+'" ?')
            $('#contentPath').val(path)
            $('#contentName').val(name)
            $('#contentType').val(type)
            $('#changeStatusModal').modal('show')
        }
        
        function next(path, folder) {
            $('#current_pathFormNextFolder').val(path)
            $('#folderFormNextFolder').val(folder)
            $('#formNextFolder').submit()
        }

        function back(parent, current) {
            $('#current_pathFormBackFolder').val(current)
            $('#folderFormBackFolder').val(parent)
            $('#formBackFolder').submit()
        }
        
        function renameFolder(path, folder) {
            $('#current_pathRenameForm').val(path)
            $('#current_nameRenameForm').val(folder)
            $('#nama_folderRenameForm').val(folder)
            $('#renameFolderModal').modal('show')
        }

        function downloadFile(path, file) {
            $('#current_pathFormDownloadFile').val(path)
            $('#fileFormDownloadFile').val(file)
            $('#formDownloadFile').submit()
        }

        function renameFile(path, file, name, ext) {
            $('#current_pathRenameFileForm').val(path)
            $('#current_nameRenameFileForm').val(file)
            $('#nama_fileRenameFileForm').val(name)
            $('#ext').val('.'+ext)
            $('#renameFileModal').modal('show')
        }

        function detail(path) {
            $('#current_pathFormDetail').val(path)
            $('#formDetail').submit()
        }

        function confirmDeleteFolder(path, folder) {
            Swal.fire({
                title: 'Hapus Folder '+folder+'?',
                text: "Anda akan kehilangan semua data pada folder ini. Lanjutkan ?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus'
                }).then((result) => {
                if (result.value) {
                    $('#current_pathFormDeleteFolder').val(path)
                    $('#folderFormDeleteFolder').val(folder)
                    $('#formDeleteFolder').submit()
                }
            })
        }

        function confirmDeleteFile(path, file) {
            Swal.fire({
                title: 'Hapus File '+file+'?',
                text: "File yang dihapus tidak dapat dikembalikan. Lanjutkan ?",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Hapus'
                }).then((result) => {
                if (result.value) {
                    $('#current_pathFormDeleteFile').val(path)
                    $('#fileFormDeleteFile').val(file)
                    $('#formDeleteFile').submit()
                }
            })
        }

        $("#uploadFile").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

            $('#single_file_size').val(this.files[0].size)
            limitTotalFileUpload(this.files.length)
        });

        $("#multiFiles").on("change", function() {
            var size = 0
            for (let i = 0; i < this.files.length; i++) {
                var filename = this.files[i].name
                // $('#multi-filename').append('<li>'+filename+'</li>')
                $('#multi-filename').append(`
                    <li class="list-group-item">
                        ${filename}<br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="inputPrivateFile[${i}]" name="isFilePrivate[${i}]" value="1" required>
                            <label class="custom-control-label" for="inputPrivateFile[${i}]">Private</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="inputSharedFile[${i}]" name="isFilePrivate[${i}]" value="0" required>
                            <label class="custom-control-label" for="inputSharedFile[${i}]">Shared</label>
                        </div>
                        <div class="form-group-inline">
                            <textarea class="form-control" rows="1" name="keterangan[${i}]" placeholder="Keterangan (dapat dikosongkan)"></textarea>
                        </div>
                    </li>
                `)
                size += this.files[i].size
            }

            $(this).siblings(".custom-file-label").addClass("selected").html(this.files.length+' file dipilih');
            $('#multi_file_size').val(size)
            limitTotalFileUpload(this.files.length)
        });

        function limitTotalFileUpload(length) {
            if (length > 10) {
                Swal.fire({
                    title: 'Peringatan!',
                    text: "File yang diupload tidak boleh lebih dari 10 file",
                    type: 'warning'
                })

                clearUpload()
            }
        }

        function clearUpload() {
            $('#uploadFile').val('')
            $('#uploadFile').siblings(".custom-file-label").removeClass("selected").html('')

            $('#multiFiles').val('')
            $('#multiFiles').siblings(".custom-file-label").removeClass("selected").html('')
            $('#multi-filename').html('')
        }

        $('#uploadButton').on('click', function() {
            clearUpload()
        })