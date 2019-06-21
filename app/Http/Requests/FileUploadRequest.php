<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class FileUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->has('file')) {
            return [
                'file' => 'required|mimes:doc,docx,xls,xlsx,ppt,pptx,pdf,txt,mp4,avi,mpga,bmp,jpg,jpeg,png,tiff,exe,rar,zip'
            ];
        } else if($this->has('files')) {
            return [
                'files.*' => 'required|mimes:doc,docx,xls,xlsx,ppt,pptx,pdf,txt,mp4,avi,mpga,bmp,jpg,jpeg,png,tiff,exe,rar,zip'
            ];
        }
    }

    public function messages()
    {
        if ($this->has('file')) {
            return [
                'file.required' => 'Tidak ada file yang di upload',
                'file.mimes' => 'Format file tidak didukung!'
            ];
        } else if ($this->has('files')) {
            return [
                'file.required' => 'Tidak ada file yang di upload',
                'files.*.mimes' => 'Upload Gagal! Terdapat format file yang tidak didukung!'
            ];
        }
    }
}
