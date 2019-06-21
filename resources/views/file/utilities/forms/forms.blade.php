{{-- next folder --}}
<form action="{{ route('folder.next') }}" method="GET" style="display: none;" id="formNextFolder">
    @csrf
    <input type="hidden" id="current_pathFormNextFolder" name="current_path" value="">
    <input type="hidden" id="folderFormNextFolder" name="folder" value="">
</form>

{{-- back folder --}}
<form action="{{ route('folder.back') }}" method="GET" style="display: none;" id="formBackFolder">
    @csrf
    <input type="hidden" id="current_pathFormBackFolder" name="current_path" value="">
    <input type="hidden" id="folderFormBackFolder" name="parent" value="">
</form>

{{-- delete folder --}}
<form action="{{ route('folder.delete') }}" method="POST" style="display: none;" id="formDeleteFolder">
    @csrf
    <input type="hidden" id="current_pathFormDeleteFolder" name="current_path" value="">
    <input type="hidden" id="folderFormDeleteFolder" name="folder" value="">
</form>

{{-- delete file --}}
<form action="{{ route('file.delete') }}" method="POST" style="display: none;" id="formDeleteFile">
    @csrf
    <input type="hidden" id="current_pathFormDeleteFile" name="current_path" value="">
    <input type="hidden" id="fileFormDeleteFile" name="file" value="">
</form>

{{-- download file --}}
<form action="{{ route('file.download') }}" method="GET" style="display: none;" id="formDownloadFile">
    @csrf
    <input type="hidden" id="current_pathFormDownloadFile" name="current_path" value="">
    <input type="hidden" id="fileFormDownloadFile" name="file" value="">
</form>

{{-- detail file --}}
<form action="{{ route('file.detail') }}" method="GET" style="display: none;" id="formDetail">
    @csrf
    <input type="hidden" id="current_pathFormDetail" name="current_path" value="">
</form>